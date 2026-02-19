import dbPool from "../../database/db.js";
import { MOVEMENTS } from "../../helpers/stock-movement.helper.js";
import StockModel from "../stock/stock.model.js";
import crypto from "crypto";

let stockModel = new StockModel();

class SalesModel {

    async createSale({ sale_total_price, building_id, user_id, product_list }) {
        let dbConnection;
        let sale_id;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let dbSaleQuery = "INSERT INTO ventas (precio_total_venta, id_local, id_usuario) VALUES (?, ?, ?);";

            let newSale = await dbConnection.query(dbSaleQuery, [
                sale_total_price,
                building_id,
                user_id
            ]);

            sale_id = newSale.insertId;
            let newBatchId = crypto.randomUUID();

            let dbSaleDetailsQuery = "INSERT INTO detalle_venta (id_venta, id_producto, cantidad_producto, precio_producto) VALUES (?, ?, ?, ?);";

            for (let item of product_list) {

                await dbConnection.query(dbSaleDetailsQuery, [
                    sale_id,
                    item.product_id,
                    item.product_quantity,
                    item.product_price
                ]);

                let dbIngredientsQuery = "SELECT id_modelo_articulo, cantidad FROM ingredientes WHERE id_producto = (?)";
                let ingredients = await dbConnection.query(dbIngredientsQuery, item.product_id);

                for (let ing of ingredients) {
                    let cantIngrediente = parseFloat(ing.cantidad) || 0;
                    let cantComprada = parseFloat(item.product_quantity) || 0;

                    let cantidadADescontar = cantIngrediente * cantComprada;
                    if (isNaN(cantidadADescontar) || cantidadADescontar <= 0) {
                        throw new Error(`Error calculando cantidad a descontar para el ingrediente ID: ${ing.id_modelo_articulo}. Cantidad ingrediente: ${ing.cantidad}, Cantidad comprada: ${item.cantidad}`);
                    }

                    let itemProcessed = {
                        item_template_id: ing.id_modelo_articulo,
                        quantity: cantidadADescontar,
                        movement_type: MOVEMENTS.TYPES.OUT
                    };

                    try {
                        await stockModel._processItemStock(
                            dbConnection,
                            building_id,
                            itemProcessed,
                            MOVEMENTS.REASONS.SALE,
                            user_id,
                            sale_id,
                            newBatchId,
                            null,
                            MOVEMENTS.RECEIPT_TYPES.TICKET
                        );
                    } catch (stockError) {
                        console.warn(`Aviso de Stock: ${stockError.message}`);

                        let friendlyError = new Error(`No hay suficiente stock para preparar el producto ID: ${item.product_id}.`);
                        friendlyError.statusCode = 400;
                        
                        throw friendlyError;
                    }
                }
            }

            await dbConnection.commit();
            return sale_id;


        } catch (error) {
            console.error("No se pudo crear el nuevo registro de venta: ", error);

            if (dbConnection) {
                dbConnection.rollback();
            }
            
            throw error;

        } finally {
            if (dbConnection) {
                dbConnection.release();
            }

        }
    }

    async getSales({ sale_id, user_id, building_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM ventas WHERE 1=1";
            let dbParams = [];

            if (sale_id) {
                dbQuery += " AND id_venta = (?)";
                dbParams.push(sale_id);
            }

            if (user_id) {
                dbQuery += " AND id_usuario = (?)";
                dbParams.push(user_id);
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
                dbConnection.release();
            }
            return result;
        }

    }

    async updateSale({ new_sale_state, sale_id }) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let dbQuery = "UPDATE ventas SET estado_venta = (?) WHERE id_venta = (?);"

            result = await dbConnection.query(dbQuery, [
                new_sale_state,
                sale_id
            ]);

        } catch (error) {
            if (dbConnection) {
                dbConnection.rollback();
            }

            result = 0;

        } finally {
            if (dbConnection) {
                dbConnection.release();
            }

            return result;
        }
    }
}

export default SalesModel;