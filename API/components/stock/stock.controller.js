import StockService from "./stock.service.js";
import * as responseBuilder from "../../helpers/response.helper.js";

const stockService = new StockService();

class StockController {

    async getStock(req, res) {
        try {
            let filters = req.query;

            let currentStock = await stockService.getStock(filters)

            return responseBuilder.success(req, res, 200, currentStock);

        } catch (error) {
            console.error(error.message);

            return responseBuilder.error(req, res, error);
        }
    }

    async updateStockMinQuantity(req, res) {
        try {
            let stock_id = req.params.stock_id;
            let { new_stock_minimum_quantity } = req.body;

            let updatedStock = await stockService.updateStockMinQuantity({ stock_id, new_stock_minimum_quantity });

            return responseBuilder.success(req, res, 200, updatedStock);

        } catch (error) {
            console.error(error.message);
            
            return responseBuilder.error(req, res, error);
        }
    }

    async createMovement(req, res) {
        try {
            let { building_id, movement_reason, items, ...extraData } = req.body;
            let user_id = req.user.id || 1;

            if (!items || !Array.isArray(items) || items.length === 0) {
                return responseBuilder.error(req, res, { statusCode: 400, message: "No se envió ninguna lista de ítems." });
            }
            
            if (movement_reason === "COMPRA_PROVEEDOR") {
                let result = await stockService.registerPurchase({
                    building_id, items, user_id, ...extraData
                });
                return responseBuilder.success(req, res, 201, result);
            }

            if (["AJUSTE_MANUAL", "ROTURA", "CONSUMO_INTERNO"].includes(movement_reason)) {
                let result = await stockService.registerAdjustments({
                    building_id, items, movement_reason, user_id
                });

                return response.success(req, res, 201, result);
            }

            return responseBuilder.error(req, res, { statusCode: 400, message: "No se pudo generar el movimiento de stock: Motivo de movimiento no válido." });

        } catch (error) {
            return responseBuilder.error(req, res, error);
        }
    }
}

export default StockController;