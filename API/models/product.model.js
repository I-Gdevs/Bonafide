import dbPool from "../database/db.js";

class ProductModel {

    async createProduct({ product_name, product_price, is_combo_bool, product_category }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "INSERT INTO producto_para_venta (nombre_producto, precio_producto, es_combo_bool, categoria_producto) VALUES (?, ?, ?, ?);";

            dbConnection.beginTransaction();

            result[0] = await dbConnection.query(dbQuery, [
                product_name,
                product_price,
                is_combo_bool,
                product_category
            ]);

            await dbConnection.commit();

        } catch (error) {
            console.error(error);

            if (dbConnection) {
                await dbConnection.rollback();
            }

        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result[0];
        }
    }

    async getProducts() {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM producto_para_venta;";

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
            console.log(result);
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