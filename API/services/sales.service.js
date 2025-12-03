import SalesModel from "../models/sales.model.js";
import ProductModel from "../models/product.model.js";

const salesModel = new SalesModel();
const productModel = new ProductModel();

class SalesService {

    async createSale({ building_id, user_id, product_list }) {

        let sale_total_price = 0;
        let parsed_product_list = [];

        if (!building_id && !user_id && !product_list) {
            throw new Error("No se puede registrar nueva venta. Datos faltantes. No se proporcionó ninguno de los parámtros { building_id, user_id, product_list }");
        }

        if (product_list.length > 0) {
            for (let item of product_list) {
                let product = await productModel.getProducts({ product_id: item.product_id });
                
                parsed_product_list.push(product[0]);

                sale_total_price += product[0].precio_producto * item.product_quantity;
            }
        }

        let newSale = await salesModel.createSale({ sale_total_price, building_id, user_id, product_list: parsed_product_list });

        if (!newSale) {
            throw new Error("No se pudo crear el nuevo registro de venta.");
        }

        return {
            newSaleId: Number(newSale),
            sale_total_price,
            building_id,
            user_id,
            product_list
        };
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