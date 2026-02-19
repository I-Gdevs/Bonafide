import SalesModel from "./sales.model.js";
import { errorHandler } from "../../helpers/error.helper.js";

const salesModel = new SalesModel();

class SalesService {

    async createSale({ building_id, user_id, product_list, sale_total_price, payment_method, customer_phone, customer_address }) {

        if (!building_id || !user_id ||!sale_total_price) {
            errorHandler.badRequest("No se puede registrar nueva venta. Datos faltantes. No se proporcionó ninguno de los parámtros { building_id, user_id, product_list }");
        }

        if (!product_list || !Array.isArray(product_list) || product_list.length === 0) {
            errorHandler.badRequest("El carrito de compras está vacío o es inválido.");
        }

        let newSale = await salesModel.createSale({ sale_total_price, building_id, user_id, product_list, payment_method, customer_phone, customer_address });

        return {
            newSaleId: Number(newSale),
            sale_sate: 'pendiente',
            sale_total_price,
            building_id,
            user_id,
            product_list
        };
    } 

    async getSales({ sale_id, user_id, building_id }) {

        let sales_list = [];

        sales_list = await salesModel.getSales({ sale_id, user_id, building_id });

        if (sales_list.length === 0) {
            throw new Error("No hay ningún registro de venta cargado.");
        }
        return sales_list;
    }

    async updateSale({ new_sale_state, sale_id }) {

        if (!new_sale_state && !sale_id) {
            throw new Error("No se puede actualizar el registro de venta. Datos faltantes. No se proporcionaron parámetros { sale_state, sale_id }.");
        }

        let updatedSale = await salesModel.updateSale({ new_sale_state, sale_id });

        if (updatedSale.affectedRows != 1) {
            throw new Error("No se pudo actualizar el estado del registro de venta.");
        }

        return updatedSale = {
            sale_id,
            new_sale_state
        }
    }

    async getSaleById(sale_id) {
        try {
            if (!sale_id || isNaN(sale_id)) {
                let error = new Error("El ID de la venta es inválido o requerido.");
                error.statusCode = 400;
                throw error;
            }

            const sale = await salesModel.getSaleById(sale_id);
            
            return sale;

        } catch (error) {
            console.error("[Service] Error al obtener detalle de venta: ", error.message);
            throw error;
        }
    }
}

export default SalesService;