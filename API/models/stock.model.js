import dbPool from "../database/db.js";

class StockModel {

    async createStock({ stock_name, stock_measurement_unit}) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "INSERT INTO ingredientes_modelo (nombre_ingrediente, unidad_medida_ingrediente) VALUES (?, ?);";

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

    async getStockTemplate() {
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

    async getStockAmount({ stock_id, building_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM ingredientes_cantidad WHERE 1=1";
            let dbParams = [];

            if (stock_id) {
                dbQuery += " AND id_ing_mod = (?)";
                dbParams.push(stock_id);
            }
            
            if (building_id) {
                dbQuery += " AND id_local = (?)";
                dbParams.push(building_id);
            }

            result = await dbConnection.query(dbQuery, dbParams);

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

            let dbQuery = `UPDATE ingredientes_modelo SET ${dbUpdates.join(", ")} WHERE id_ing_mod = (?);`

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

    async moveStock({ stock_movement_date, stock_movement_type, stock_movement_reason, building_id, provider_id, stock_list }) {
        let dbConnection;
        let stock_movement_id;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            // Primero armamos el comprobante general
            let dbMovementQuery;
            
            let dbMovementParams = [
                building_id,
                provider_id,
                stock_movement_reason,
                stock_movement_type
            ];

            if (stock_movement_date) {
                dbMovementQuery = `INSERT INTO comprobante_compra (fecha_comprobante, id_local, id_proveedor, motivo_comprobante, tipo_comprobante) VALUES (?, ?, ?, ?, ?);`

                dbMovementParams.unshift(stock_movement_date);

            } else {
                dbMovementQuery = "INSERT INTO comprobante_compra (id_local, id_proveedor, motivo_comprobante, tipo_comprobante) VALUES (?, ?, ?, ?);"
            }

            let movementResult = await dbConnection.query(dbMovementQuery, dbMovementParams);

            stock_movement_id = movementResult.insertId;

            // Con el comprobante general ya armado, cargamos cada item del movimiento de stock
            let dbDetailsQuery = `INSERT INTO detalle_compra (id_comprobante, id_ing_mod, cantidad_ingrediente) VALUES (?, ?, ?);`;
            
            // Si nunca se ingresó stock de este item
            let dbStockQueryInsert = `INSERT INTO ingredientes_cantidad (cantidad_ingrediente, id_local, id_ing_mod) VALUES (?, ?, ?);`;

            // Si ya hay stock previo de este item
            let dbStockQueryUpdate = `UPDATE ingredientes_cantidad SET cantidad_ingrediente = cantidad_ingrediente + (?) WHERE id_local = (?) AND id_ing_mod = (?);`;


            for (let item of stock_list) {
                
                await dbConnection.query(dbDetailsQuery, [
                    stock_movement_id,
                    item.stock_id,
                    item.stock_quantity
                ]);

                let existentStock = await this.getStockAmount({ stock_id: item.stock_id, building_id });

                if (existentStock.length > 0) {
                    await dbConnection.query(dbStockQueryUpdate, [
                        item.stock_quantity,
                        building_id,
                        item.stock_id
                    ]);

                } else {
                    await dbConnection.query(dbStockQueryInsert, [
                        item.stock_quantity,
                        building_id,
                        item.stock_id
                    ]);
                }
            }

            await dbConnection.commit();

            return { stock_movement_id };

        } catch (error) {
            console.error("No se pudo realizar el nuevo movimiento de stock: ", error.message);

            if (dbConnection) {
                dbConnection.rollback();
            }

        } finally {
            if (dbConnection) {
                dbConnection.release();
            }

            return stock_movement_id;
        }
    }
}

export default StockModel;