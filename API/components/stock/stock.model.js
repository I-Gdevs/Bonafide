import dbPool from "../../database/db.js";
import { MOVEMENTS } from "../../helpers/stock-movement.helper.js";
import crypto from "crypto";

class StockModel {

    async getStock(filters) {
        let dbConnection;

        let result = [];
        let dbParams = [];
        
        let dbQuery = `
            SELECT
                s.id_stock,
                m.nombre_modelo_articulo,
                s.cantidad_stock,
                s.cantidad_minima_stock,
                m.unidad_medida_modelo_articulo,
                s.id_local,
                l.nombre_local
            FROM
                stock s
            INNER JOIN
                modelos_de_articulos m ON s.id_modelo_articulo = m.id_modelo_articulo
            INNER JOIN
                locales l ON s.id_local = l.id_local
            WHERE
                1=1
        `;

        if (filters.building_id) {
            dbQuery += " AND s.id_local = (?)";
            dbParams.push(filters.building_id);
        }

        dbQuery += " AND m.modelo_articulo_desactivado_bool = 0;";

        try {
            dbConnection = await dbPool.getConnection();
                    
            result = await dbConnection.query(dbQuery, dbParams);

        } catch (error) {
            console.error(error);
            
            if (dbConnection) {
                await dbConnection.release();
            }

            throw error;
            
        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            return result;
        }
    }

    async getStockMovements(filters) {
        let dbConnection;
        let movements = [];
        let dbParams = [];

        let dbQuery = `
            SELECT
                ms.id_movimiento_stock,
                ms.fecha,
                ms.tipo_movimiento,
                ms.motivo_movimiento,
                ms.cantidad_movida,
                ms.tipo_comprobante,
                ms.numero_recibo,
                ms.id_lote_movimiento,
                m.nombre_modelo_articulo,
                m.unidad_medida_modelo_articulo,
                l.nombre_local,
                u.nombre_usuario,
                p.nombre_proveedor
            FROM movimientos_stock ms
            INNER JOIN stock s ON ms.id_stock = s.id_stock
            INNER JOIN modelos_de_articulos m ON s.id_modelo_articulo = m.id_modelo_articulo
            INNER JOIN locales l ON s.id_local = l.id_local
            LEFT JOIN usuarios u ON ms.id_usuario = u.id_usuario
            LEFT JOIN proveedores p ON ms.id_proveedor = p.id_proveedor
            WHERE 1=1
        `;

        if (filters.building_id) {
            dbQuery += " AND s.id_local = (?)";
            dbParams.push(filters.building_id);
        }
        if (filters.item_template_id) {
            dbQuery += " AND s.id_modelo_articulo = (?)";
            dbParams.push(filters.item_template_id);
        }
        if (filters.movement_batch_id) {
            dbQuery += " AND ms.id_lote_movimiento = (?)";
            dbParams.push(filters.movement_batch_id);
        }
        if (filters.date_from) {
            dbQuery += " AND ms.fecha >= (?)";
            dbParams.push(filters.date_from);
        }
        if (filters.date_to) {
            dbQuery += " AND ms.fecha <= (?)";
            dbParams.push(filters.date_to + " 23:59:59");
        }
        

        dbQuery += " ORDER BY ms.fecha DESC LIMIT 500";

        try {
            dbConnection = await dbPool.getConnection();
            
            movements = await dbConnection.query(dbQuery, dbParams);
        } catch (error) {
            console.error(error);
            if (dbConnection) {
                await dbConnection.release();
            }
            throw error;
        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            return movements;
        }
    }

    async updateStockMinQuantity({ stock_id, new_stock_minimum_quantity }) {
        let dbConnection;

        let result = [];

        let dbQuery = `
            UPDATE stock SET cantidad_minima_stock = (?)
            WHERE id_stock = (?);
        `;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, [new_stock_minimum_quantity, stock_id]);

            await dbConnection.commit();
            
            return { "affectedRows": result.affectedRows }
        } catch (error) {
            console.error(error)

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

    async createAdjustmentMovement({ building_id, items, movement_reason, user_id }) {
        let dbConnection;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let newBatchId = crypto.randomUUID();

            for (let item of items) {
                let quantity = parseFloat(item.quantity);
                
                let type = quantity >= 0 ? "IN" : "OUT"; 

                let itemProcessed = {
                    item_template_id: item.item_template_id,
                    quantity: Math.abs(quantity), 
                    movement_type: type 
                };

                await this._processItemStock(
                    dbConnection, 
                    building_id, 
                    itemProcessed,
                    movement_reason, 
                    user_id, 
                    null, 
                    newBatchId
                );
            }

            await dbConnection.commit();
            return { data: "Movimientos registrados correctamente."};

        } catch (error) {
            console.error("Error al generar movimientos de stock:", error);

            if (dbConnection) {
                await dbConnection.rollback();
            }

            throw error;

        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
        }
    }


    async createPurchaseMovement({ building_id, items, provider_id, receipt_type, receipt_number, user_id }) {
        let dbConnection;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let newBatchId = crypto.randomUUID();

            for (let item of items) {

                let itemDataForStock = {
                    ...item, 
                    quantity: Math.abs(parseFloat(item.quantity)),
                    movement_type: MOVEMENTS.TYPES.IN
                };
                
                await this._processItemStock(
                    dbConnection,
                    building_id,
                    itemDataForStock,
                    MOVEMENTS.REASONS.PURCHASE,
                    user_id,
                    receipt_number,
                    newBatchId,
                    provider_id,
                    receipt_type
                );
            }

            await dbConnection.commit();

            return {
                success: true,
                message: "Movimientos por compra a proveedor registrados correctamente.",
                batch_id: newBatchId
            };

        } catch (error) {
            console.error(error);

            if (dbConnection) {
                await dbConnection.rollback();
            }

            throw error;

        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
        }
    }

    async _processItemStock(dbConnection, building_id, item, movement_reason, user_id, reference_id, batch_movement_id, providerId = null, receiptType = null) {
        
        if (item.quantity <= 0) {
            throw new Error(`No se pudo generar el movimiento: El item se ${item.item_template_id} envió con cantidad: 0.`);
        }

        let checkPriorExistence_dbQuery = `
            SELECT id_stock, cantidad_stock
            FROM stock
            WHERE id_local = (?) AND id_modelo_articulo = (?)
            FOR UPDATE;
        `;
        
        let resultCheck = await dbConnection.query(checkPriorExistence_dbQuery, [building_id, item.item_template_id]);

        let stock_id;
        let current_quantity = 0;

        if (resultCheck.length === 0) {
            if (item.type === "OUT") {
                throw new Error(`No se puede egresar el artículo ${item.item_template_id} porque no tiene stock en este local.`);
            }

            let insertQuery = `
                INSERT INTO stock (id_local, id_modelo_articulo, cantidad_stock, cantidad_minima_stock)
                VALUES (?, ?, 0, 0);
            `;

            let insertResult = await dbConnection.query(insertQuery, [building_id, item.item_template_id]);
            stock_id = insertResult.insertId;

        } else {
            stock_id = resultCheck[0].id_stock;
            current_quantity = parseFloat(resultCheck[0].cantidad_stock);
        }

        let new_quantity = current_quantity;
        let quantity_to_move = parseFloat(item.quantity);

        if (item.movement_type === "IN") {
            new_quantity += quantity_to_move;
        } else {
            if (current_quantity < quantity_to_move) {
                throw new Error(`Stock insuficiente para el artículo ${item.item_template_id}. Se tiene ${current_quantity} y se debe mover ${quantity_to_move}.`);
            }
            new_quantity -= quantity_to_move;
        }

        await dbConnection.query(
            "UPDATE stock SET cantidad_stock = (?) WHERE id_stock = (?);",
            [new_quantity, stock_id]
        );

        let logQuery = `
            INSERT INTO movimientos_stock
            (
                id_stock,
                tipo_movimiento,
                motivo_movimiento,
                cantidad_movida,
                stock_antes,
                stock_despues,
                id_usuario,
                numero_recibo,
                id_lote_movimiento,
                id_proveedor,
                tipo_comprobante
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
        `;

        console.log("Tratando de guardar recibo:", reference_id);

        await dbConnection.query(logQuery, [
            stock_id,
            item.movement_type,
            movement_reason,
            quantity_to_move,
            current_quantity,
            new_quantity,
            user_id,
            reference_id || null,
            batch_movement_id,
            providerId,
            receiptType
        ]);
    }
}

export default StockModel;