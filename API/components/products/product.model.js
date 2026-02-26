import dbPool from "../../database/db.js";
import { errorHandler } from "../../helpers/error.helper.js";

class ProductModel {

    async createProduct({ product_name, product_price, is_combo_bool, product_category, product_description, product_image_url, product_ingredients }) {
        let dbConnection;

        try {
            dbConnection = await dbPool.getConnection();

            let dbQueryProducto = "INSERT INTO productos (nombre_producto, precio_producto, es_combo_bool, categoria_producto, descripcion_producto, imagen_url) VALUES (?, ?, ?, ?, ?, ?);";

            await dbConnection.beginTransaction();

            let resultProduct = await dbConnection.query(dbQueryProducto, [
                product_name,
                product_price,
                is_combo_bool,
                product_category,
                product_description,
                product_image_url
            ]);

            let newProductId = Number(resultProduct.insertId);

            if (product_ingredients && product_ingredients.length > 0) {
                let dbQueryIngredients = `INSERT INTO ingredientes (id_producto, id_modelo_articulo, cantidad) VALUES (?, ?, ?)`;
                let dbParams = product_ingredients.map(ing => [ newProductId, ing.id, ing.cantidad ]);

                await dbConnection.batch(dbQueryIngredients, dbParams);
            
            }

            await dbConnection.commit();
            return resultProduct;

        } catch (error) {
            console.error("[Model] Error:", error);

            if (dbConnection) {
                await dbConnection.rollback();
            }

            if (error.code === 'ER_NO_REFERENCED_ROW_2') {
                errorHandler.badRequest("Uno de los ingredientes seleccionados no existe en el stock.");
            }

            if (error.code === 'ER_DUP_ENTRY') {
                errorHandler.conflict("Ya existe un producto con ese nombre.");
            }

            if (error.isOperational) throw error;
            
            errorHandler.custom("Error de base de datos al crear producto.", 500);
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
        }
    }

    async getProducts({ product_id, building_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            // 1. Buscamos los productos. 
            // Si nos pasan un building_id, calculamos el stock máximo posible ("stock_disponible").
            // La fórmula es: dividir la cantidad en stock por la cantidad requerida en la receta, 
            // y quedarnos con el número más bajo (el ingrediente limitante).
            let dbQueryProducts = `
                SELECT 
                    p.*
                    ${building_id ? `, COALESCE(
                        (SELECT MIN(FLOOR(COALESCE(s.cantidad_stock, 0) / i.cantidad))
                         FROM ingredientes i
                         LEFT JOIN stock s ON i.id_modelo_articulo = s.id_modelo_articulo AND s.id_local = ?
                         WHERE i.id_producto = p.id_producto
                        ), 0) AS stock_disponible` : ''}
                FROM productos p
                WHERE p.producto_desactivado_bool = 0
            `;
            
            let dbParamsProducts = [];
            
            if (building_id) {
                dbParamsProducts.push(building_id);
            }

            if (product_id) {
                dbQueryProducts += " AND p.id_producto = ?";
                dbParamsProducts.push(product_id);
            }

            let products = await dbConnection.query(dbQueryProducts, dbParamsProducts);
            
            // 2. Buscamos los ingredientes como lo hacías antes
            let dbQueryIngredients = `
                SELECT
                    i.id_producto,
                    i.id_modelo_articulo,
                    i.cantidad,
                    m.nombre_modelo_articulo AS nombre,
                    m.unidad_medida_modelo_articulo AS unidad
                FROM ingredientes i
                INNER JOIN modelos_de_articulos m ON i.id_modelo_articulo = m.id_modelo_articulo
            `;
            let ingredients = await dbConnection.query(dbQueryIngredients);

            // 3. Armamos el objeto final
            result = products.map(prod => {
                prod.ingredientes = ingredients.filter(r => r.id_producto == prod.id_producto);
                
                // Si el producto no tiene ingredientes (es raro, pero por las dudas), 
                // le ponemos un stock alto o 0 según tu lógica de negocio.
                if (building_id && prod.ingredientes.length === 0) {
                     prod.stock_disponible = 99; // O cero, si preferís que no se venda sin receta.
                }

                return prod;
            });

        } catch (error) {
            console.error("[Model] Error en getProducts:", error);
            // El release lo hacemos en el finally
        } finally {
            if (dbConnection) {
                dbConnection.release(); // Corrección: no lleva await
            }
            return result;
        }
    }

    async updateProduct({ product_id, new_product_name, new_product_price, is_combo_bool, new_product_category, new_product_description, new_product_image_url, new_product_ingredients }) {
        let dbConnection;
        let resultUpdate = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQueryUpdateProduct = `
                UPDATE productos 
                SET nombre_producto = ?, 
                    precio_producto = ?, 
                    categoria_producto = ?, 
                    descripcion_producto = ?, 
                    imagen_url = ? 
                WHERE id_producto = ?
            `;

            await dbConnection.beginTransaction();

            resultUpdate = await dbConnection.query(dbQueryUpdateProduct, [
                new_product_name,
                new_product_price,
                new_product_category,
                new_product_description,
                new_product_image_url,
                product_id
            ]);

            if (resultUpdate.affectedRows === 0) {
                let error = new Error("El producto no existe.");
                error.statusCode = 404; 
                error.isOperational = true;
                throw error;
            }

            let dbQueryDeleteIngredients = "DELETE FROM ingredientes WHERE id_producto = ?";
            await dbConnection.query(dbQueryDeleteIngredients, product_id);

            if (new_product_ingredients && new_product_ingredients.length > 0) {
                let dbQueryUpdateIngredients = `INSERT INTO ingredientes (id_producto, id_modelo_articulo, cantidad) VALUES (?, ?, ?)`;
                
                let dbParams = new_product_ingredients.map(ing => [ product_id, ing.id, ing.cantidad ]);

                await dbConnection.batch(dbQueryUpdateIngredients, dbParams);
            }

            await dbConnection.commit();


        } catch (error) {
            console.error(error);

            if (dbConnection) {
                dbConnection.rollback();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return resultUpdate;
        }
    }

    async deleteProduct({ product_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            dbConnection.beginTransaction();

            let dbQuery = "UPDATE productos SET producto_desactivado_bool = 1 WHERE id_producto = (?);"

            result = await dbConnection.query(dbQuery, product_id);

            dbConnection.commit();

        } catch (error) {
            console.error(error);

            if (dbConnection) {
                dbConnection.rollback();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result;
        }
    }
}

export default ProductModel;