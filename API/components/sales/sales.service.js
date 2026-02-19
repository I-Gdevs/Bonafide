import SalesModel from "./sales.model.js";
import ProductModel from "../products/product.model.js";
import { errorHandler } from "../../helpers/error.helper.js";

const salesModel = new SalesModel();
const productModel = new ProductModel();

class SalesService {

    async createSale({ building_id, user_id, product_list }) {

        let sale_total_price = 0;

        if (!building_id && !user_id) {
            errorHandler.badRequest("No se puede registrar nueva venta. Datos faltantes. No se proporcionó ninguno de los parámtros { building_id, user_id, product_list }");
        }

        if (!product_list || !Array.isArray(product_list) || product_list.length === 0) {
            errorHandler.badRequest("El carrito de compras está vacío o es inválido.");
        }

        sale_total_price = product_list.reduce((acc, item) => acc + (item.product_price * item.product_quantity), 0);

        let newSale = await salesModel.createSale({ sale_total_price, building_id, user_id, product_list });

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
}

export default SalesService;