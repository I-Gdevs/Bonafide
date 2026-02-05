import StockModel from "./stock.model.js";
import { errorHandler } from "../../helpers/error.helper.js";
import { MOVEMENTS } from "../../helpers/stock-movement.helper.js";

const stockModel = new StockModel();

class StockService {

    async getStock(filters) {

        let currentStock = [];

        currentStock = await stockModel.getStock(filters);

        if (currentStock.length === 0) {
            errorHandler.notFound("No hay nada de stock cargado.");
        }

        return currentStock;
    }

    async updateStockMinQuantity({ stock_id, new_stock_minimum_quantity }) {
        
        if (!stock_id || !new_stock_minimum_quantity) {
            errorHandler.badRequest("No se pudo actualizar la mínima cantidad de stock: Faltan parámetros.");
        }

        return await stockModel.updateStockMinQuantity({ stock_id, new_stock_minimum_quantity });
    }

    async registerPurchase({ building_id, items, provider_id, receipt_type, user_id }) {

        if (!provider_id) {
            errorHandler.badRequest("No se puede registrar compra: Falta especificar proveedor.");
        }

        return await stockModel.createPurchaseMovement({
            building_id,
            items,
            provider_id,
            receipt_type,
            user_id
        });
    }

    async registerAdjustments({ building_id, items, movement_reason, user_id }) {

        let validReasons = [MOVEMENTS.REASONS.ADJUSTMENT, MOVEMENTS.REASONS.BROKEN, MOVEMENTS.REASONS.INTERNAL_USE];
        if (!validReasons.includes(movement_reason)) {
            errorHandler.badRequest("Motivo de movimiento no válido");
        }

        return await stockModel.createAdjustmentMovement({
            building_id,
            items,
            movement_reason,
            user_id
        });
    }

    async getStockMovements(filters) {
        let movements = await stockModel.getStockMovements(filters);
        let batchMovements = [];
        let groupsMap = {};

        for (let movement of movements) {
            
            let groupKey = movement.id_lote_movimiento;

            if (!groupsMap[groupKey]) {
                groupsMap[groupKey] = {
                    id_lote_movimiento: movement.id_lote_movimiento,
                    id_referencia: movement.id_referencia,
                    fecha: movement.fecha,
                    tipo_movimiento: movement.tipo_movimiento,
                    motivo_movimiento: movement.motivo_movimiento,
                    usuario: movement.nombre_usuario,
                    nombre_local: movement.nombre_local,
                    items: []
                };

                batchMovements.push(groupsMap[groupKey]);
            }

            groupsMap[groupKey].items.push({
                nombre_modelo_articulo: movement.nombre_modelo_articulo,
                cantidad_movida: movement.cantidad_movida,
                unidad_medida_modelo_articulo: movement.unidad_medida_modelo_articulo
            });
        }

        return batchMovements;
    }
}

export default StockService;