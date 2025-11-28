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

    async getStock() {
        
        let stock = [];

        stock = await stockModel.getStock();

        if (stock.length === 0) {
            throw new Error("No hay ningún ingrediente/stock cargado.");
        }
        return stock;
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
}

export default StockService;