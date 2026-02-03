import dbPool from "../../database/db.js";
import { MOVEMENTS } from "../../helpers/stock-movement.helper.js";

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
                ms.id_referencia,
                m.nombre_modelo_articulo,
                m.unidad_medida_modelo_articulo,
                l.nombre_local,
                u.nombre_usuario
            FROM movimientos_stock ms
            INNER JOIN stock s ON ms.id_stock = s.id_stock
            INNER JOIN modelos_de_articulos m ON s.id_modelo_articulo = m.id_modelo_articulo
            INNER JOIN locales l ON s.id_local = l.id_local
            LEFT JOIN usuarios u ON ms.id_usuario = u.id_usuario
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

            for (let item of items) {
                await this._processItemStock(dbConnection, building_id, item, movement_reason, user_id);
            }

            await dbConnection.commit();
            return { success: true, message: "Movimientos registrados correctamente." };

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

    async createPurchaseMovement({ building_id, items, provider_id, receipt_type, user_id }) {
        let dbConnection;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let purchaseQuery = await dbConnection.query(
                `INSERT INTO comprobante_compra (id_local, id_proveedor, motivo_comprobante, tipo_comprobante)
                VALUES (?, ?, ?, ?);
                `,
                [building_id, provider_id, MOVEMENTS.REASONS.PURCHASE, receipt_type]
            );

            let newPurchaseId = purchaseQuery.insertId;

            for (let item of items) {
                await dbConnection.query(
                    `INSERT INTO detalle_compra (id_comprobante, id_modelo_articulo, cantidad_comprada) VALUES (?, ?, ?);`,
                    [newPurchaseId, item.item_template_id, item.quantity]
                );

                let itemDataForStock = { ...item, movement_type: MOVEMENTS.TYPES.IN };
                await this._processItemStock(
                    dbConnection,
                    building_id,
                    itemDataForStock,
                    MOVEMENTS.REASONS.PURCHASE,
                    user_id,
                    newPurchaseId
                );
            }

            await dbConnection.commit();

            return {
                success: true,
                message: "Comprobante de compra registrado con éxito.",
                id_comprobante: Number(newPurchaseId)
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

    async _processItemStock(dbConnection, building_id, item, movement_reason, user_id, reference_id) {
        
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
            INSERT INTO movimientos_stock (id_stock, tipo_movimiento, motivo_movimiento, cantidad_movida, stock_antes, stock_despues, id_usuario, id_referencia)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);
        `;

        await dbConnection.query(logQuery, [
            stock_id,
            item.movement_type,
            movement_reason,
            quantity_to_move,
            current_quantity,
            new_quantity,
            user_id,
            reference_id || null
        ]);
    }
}

export default StockModel;