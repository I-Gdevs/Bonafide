import SalesService from "./sales.service.js";
import * as responseBuilder from "../../helpers/response.helper.js";

const salesService = new SalesService();

class SalesController {

    async createSale(req, res) {
        try {
            let { building_id, user_id, product_list, sale_total_price, payment_method, customer_phone, customer_address } = req.body;

            let newSale = await salesService.createSale({ building_id, user_id, product_list, sale_total_price, payment_method, customer_phone, customer_address });

            return responseBuilder.success(req, res, 201, newSale, "Venta procesada correctamente");
        } catch (error) {
            console.log("[Controller] Error al intentar crear nuevo registro de venta: ", error);

            if (error.isOperationl) {
                return responseBuilder.error(req, res, error);
            }
            
            return responseBuilder.error(req, res, error);
        }
    }

    async getSales(req, res) {
        try {
            let { sale_id, user_id, building_id } = req.body;

            let sales_list = await salesService.getSales({ sale_id, user_id, building_id });

            return res.status(200).json({
                message: "Se pudo buscar correctamente los registros de ventas.",
                sales_list
            });
        } catch (error) {
            console.log("Error al intentar buscar los registros de ventas: ", error.message);

            if (error.message.includes("No hay")) {
                return res.status(404).json({
                    error: error.message
                });
            }
            
            return res.status(500).json({
                error: "Error interno al intentar buscar la lista de ventas."
            })
        }
    }

    async updateSale(req, res) {
        try {
            let { new_sale_state, sale_id } = req.body;

            let updatedSale = await salesService.updateSale({ new_sale_state, sale_id });
            
            return res.status(200).json({
                message: "Registro de venta actualizado correctamente.",
                updatedSale
            });
        } catch (error) {
            console.log("Error al intentar actualizar registro de venta: ", error.message);

            if (error.message.includes("faltantes")) {
                return res.status(400).json({
                    error: error.message
                });
            }
            
            return res.status(500).json({
                error: "Error interno al intentar actualizar registro de venta."
            });
        }
    }

    async getSaleById(req, res) {
        try {
            const { id } = req.params;

            const saleData = await salesService.getSaleById(id);

            return res.status(200).json({
                success: true,
                res: saleData
            });

        } catch (error) {
            console.error("[Controller] Error al obtener detalle de venta: ", error);
            
            const httpStatus = error.statusCode || 500;
            
            return res.status(httpStatus).json({
                success: false,
                error: error.message
            });
        }
    }
}

export default SalesController;