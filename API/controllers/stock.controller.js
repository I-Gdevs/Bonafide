import StockService from "../services/stock.service.js";

const stockService = new StockService();

class StockController {
    
    async createStock(req, res) {
        try {
            let { stock_name, stock_measurement_unit } = req.body
            
            let newStock = await stockService.createStock({ stock_name, stock_measurement_unit });

            return res.status(200).json({
                message: "Nuevo ingrediente/stock creado correctamente.",
                newStock
            });
        } catch (error) {
            console.log("Error al crear un ingrediente/stock nuevo: ", error.message);
            
            return res.status(500).json({
                error: "Error interno al crear nuevo ingrediente."
            });
        }
    }

    async getStock(req, res) {
        try {
            let stockList = await stockService.getStock();

            return res.status(200).json({
                stock_list: stockList
            });
        } catch (error) {
            console.log("Error al buscar la lista de ingredientes/stock: ", error.message);

            if (error.message.includes("No hay")) {
                return res.status(404).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al buscar la lista de ingredientes/stock."
            });
        }
    }

    async updateStock(req, res) {
        try {
            let { stock_id, new_stock_name, new_stock_measurement_unit } = req.body;

            let updatedStock = await stockService.updateStock({ stock_id, new_stock_name, new_stock_measurement_unit });

            return res.staus(200).json({
                message: "Ingrediente/stock actualizado correctamente",
                updatedStock
            });
        } catch (error) {
            console.error("Error al intentar actualizar datos del ingrediente/stock: ", error.message);

            if (error.message.includes("faltantes")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar actualizar datos del ingrediente/stock."
            });
        }
    }
}

export default StockController;