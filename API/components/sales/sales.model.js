import dbPool from "../../database/db.js";
import { MOVEMENTS } from "../../helpers/stock-movement.helper.js";
import StockModel from "../stock/stock.model.js";
import crypto from "crypto";

let stockModel = new StockModel();

class SalesModel {

    async createSale({ sale_total_price, building_id, user_id, product_list, payment_method, customer_phone, customer_address }) {
        let dbConnection;
        let sale_id;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let direccionFinal = (customer_address && customer_address.trim() !== "") ? customer_address.trim() : null;
            let celularFinal = customer_phone || null;

            let dbSaleQuery = "INSERT INTO ventas (precio_total_venta, id_local, id_usuario, celular_cliente, direccion_envio) VALUES (?, ?, ?, ?, ?);";

            let newSale = await dbConnection.query(dbSaleQuery, [
                sale_total_price,
                building_id,
                user_id,
                celularFinal,
                direccionFinal
            ]);

            sale_id = newSale.insertId;

            let dbChargeQuery = "INSERT INTO cobros (id_venta, monto_cobrado, metodo_pago) VALUES (?, ?, ?);";
            await dbConnection.query(dbChargeQuery, [
                sale_id,
                sale_total_price,
                payment_method || "Efectivo"
            ]);

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

    async getSales({ user_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = `
                SELECT 
                    v.*, 
                    u.nombre_usuario, 
                    u.dni_usuario,
                    c.fecha_cobro as fecha_venta
                FROM ventas v
                INNER JOIN usuarios u ON v.id_usuario = u.id_usuario
                LEFT JOIN cobros c ON v.id_venta = c.id_venta
            `;
            let dbParams = [];

            if (user_id) {
                dbQuery += " WHERE v.id_usuario = ?";
                dbParams.push(user_id);
            }

            dbQuery += " ORDER BY v.id_venta DESC";

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

    async getSaleById(sale_id) {
        let dbConnection;

        try {
            dbConnection = await dbPool.getConnection();

            let sqlCabecera = `
                SELECT 
                    v.id_venta, 
                    v.precio_total_venta, 
                    v.direccion_envio, 
                    c.metodo_pago, 
                    c.fecha_cobro,
                    u.nombre_usuario, 
                    u.dni_usuario
                FROM ventas v
                LEFT JOIN cobros c ON v.id_venta = c.id_venta
                LEFT JOIN usuarios u ON v.id_usuario = u.id_usuario
                WHERE v.id_venta = ?
            `;
                    
            let cabeceraRows = await dbConnection.query(sqlCabecera, [sale_id]);

            if (cabeceraRows.length === 0) {
                throw new Error("Venta no encontrada");
            }

            let cabeceraInfo = cabeceraRows[0];

            let sqlDetalle = `
                SELECT 
                    dv.cantidad_producto, 
                    dv.precio_producto, 
                    p.nombre_producto
                FROM detalle_venta dv
                INNER JOIN productos p ON dv.id_producto = p.id_producto
                WHERE dv.id_venta = ?
            `;
            let detalles = await dbConnection.query(sqlDetalle, [sale_id]);

            return {
                ...cabeceraInfo,
                productos: detalles
            };

        } catch (error) {
            throw error;
        } finally {
            if (dbConnection) dbConnection.release();
        }
    }
}

export default SalesModel;