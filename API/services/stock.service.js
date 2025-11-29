import StockModel from "../models/stock.model.js";

const stockModel = new StockModel();

class StockService {
    
    async createStock({ stock_name, stock_measurement_unit}) {

        let newStock = await stockModel.createStock({ stock_name, stock_measurement_unit });

        return {
            newStockId: Number(newStock.insertId),
            stock_name,
            stock_measurement_unit
        }
    }

    async getStockTemplate() {
        
        let stockTemplates = [];

        stockTemplates = await stockModel.getStockTemplate();

        if (stockTemplates.length === 0) {
            throw new Error("No hay ningún modelo de stock cargado.");
        }
        return stockTemplates;
    }

    async getStockAmount({ stock_id, building_id }) {

        let stockAmount = [];

        stockAmount = await stockModel.getStockAmount({ stock_id, building_id });

        if (stockAmount.length === 0) {
            throw new Error("No hay nada de stock cargado.");
        }
        return stockAmount;
    }

    async updateStock({ stock_id, new_stock_name, new_stock_measurement_unit }) {

        if (!stock_id) {
            throw new Error("No se puede actualizar ingrediente/stock. Datos faltantes. No se proporcionó ningún ID de ingrediente/stock.");
        }

        if (!new_stock_name && !new_stock_measurement_unit && !new_stock_building_id) {
            throw new Error("No se puede actualizar ingrediente/stock. Datos faltantes. No se envió ningún cambio { new_stock_name, new_stock_measurement_unit }");
        }

        let updatedStock = await stockModel.updateStock({ stock_id, new_stock_name, new_stock_measurement_unit });

        if (updatedStock.affectedRows !== 1) {
            throw new Error("No se pudo actualizar ingrediente/stock.");
        }

        return updatedStock = {
            stock_id,
            new_stock_name,
            new_stock_measurement_unit
        }
    }

    async deleteStock({}) {

    }

    async moveStock({ stock_movement_type, stock_movement_reason, building_id, provider_id, stock_list }) {
        let movedStock;

        if (!stock_movement_reason || !stock_movement_type) {
            throw new Error("No se puede cargar movimiento de stock. Datos faltantes. No se proporcionó motivo o tipo de movimiento { stock_movement_type, stock_movement_reason }.");
        }

        if (!building_id) {
            throw new Error("No se puede cargar movimiento de stock. Datos faltantes. No se proporcionó ningún local { building_id }.");
        }

        if (!stock_list) {
            throw new Error("No se puede cargar movimiento de stock. Datos faltantes. No se proporcionó ningún ítem [{ stock_id, stock_quantity }, ...] ");
        }

        // Si el movimiento es por ajuste manual, entonces no enviamos ningún prooveedor.
        if (stock_movement_reason.includes("ajuste")) {
            movedStock = stockModel.moveStock({ stock_movement_type, stock_movement_reason, building_id, provider_id: null, stock_list });
        } else {
            movedStock = stockModel.moveStock({ stock_movement_type, stock_movement_reason, building_id, provider_id, stock_list });
        }

        if (!movedStock) {
            throw new Error("No se pudo cargar nuevo movimiento de stock");
        }

        return movedStock;
    }
}

export default StockService;