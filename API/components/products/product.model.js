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

    async getProducts({ product_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM productos WHERE producto_desactivado_bool = 0";

            if (product_id) {
                dbQuery += ` AND id_producto = ${product_id};`;
            }
            
            result = await dbConnection.query(dbQuery);

        } catch (error) {
            if (dbConnection) {
                await dbConnection.release();
            }
            console.error(error);

        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            return result;
        }
    }

    async updateProduct({ product_id, new_product_name, new_product_price, new_product_category }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbUpdates = [];
            let dbParams = [];

            if (new_product_name) {
                dbUpdates.push("nombre_producto = (?)");
                dbParams.push(new_product_name);
            }

            if (new_product_price) {
                dbUpdates.push("precio_producto = (?)");
                dbParams.push(new_product_price);
            }

            if (new_product_category) {
                dbUpdates.push("categoria_producto = (?)");
                dbParams.push(new_product_category);
            }

            dbParams.push(product_id);

            let dbQuery = `UPDATE producto_para_venta SET ${dbUpdates.join(", ")} WHERE id_producto = (?);`

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, dbParams);

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
            return result;
        }
    }

    async deleteProduct({ product_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            dbConnection.beginTransaction();

            let dbQuery = "UPDATE producto_para_venta SET producto_desactivado_bool = 1 WHERE id_producto = (?);"

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