import dbPool from "../database/db.js";

class StockModel {

    async createStock({ stock_name, stock_measurement_unit}) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "INSERT INTO ingredientes_modelos (nombre_ingrediente, unidad_medida_ingrediente) VALUES (?, ?);";

            dbConnection.beginTransaction();

            result[0] = await dbConnection.query(dbQuery, [
                stock_name,
                stock_measurement_unit
            ]);

            await dbConnection.commit();

        } catch (error) {
            console.error(error);
            
            if (dbConnection) {
                await dbConnection.rollback();
            }

        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            return result[0];
        }
    }

    async getStock() {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM ingredientes_modelo;";

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

    async updateStock({ stock_id, new_stock_name, new_stock_measurement_unit }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbUpdates = [];
            let dbParams = [];

            if (new_stock_name) {
                dbUpdates.push("nombre_ingrediente = (?)");
                dbParams.push(new_stock_name);
            }
            
            if (new_stock_measurement_unit) {
                dbUpdates.push("unidad_medida_ingrediente = (?)");
                dbParams.push(new_stock_measurement_unit);
            }

            dbParams.push(stock_id);

            let dbQuery = `UPDATE ingredientes_modelo SET ${dbUpdates.join(", ")} WHERE id_ing_mod = (?)`

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, dbParams);

            await dbConnection.commit();

        } catch (error) {
            console.error(error);
            
            if (dbConnection) {
                dbConnection.release();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            console.log(result);
            return result;
        }
    }
}

export default StockModel;