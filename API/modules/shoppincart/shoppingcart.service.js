import ShoppingCartModel from "./shoppingcart.model.js";
import ProductModel from "../product/product.model.js";

const shoppingcartModel = new ShoppingCartModel();
const productModel = new ProductModel();

class ShoppingCartService {
    
    async createCart({ building_id, user_id, product_list }) {

        let cart_total_price = 0;

        if (!building_id && !user_id && !product_list) {
            throw new Error("No se puede crear el carrito. Datos faltantes. No se proporcionó alguno de los parámetros { building_id, user_id, product_list }");
        }

        if (product_list.length > 0) {
            for (let item of product_list) {
                let product = await productModel.getProducts({ product_id: item.product_id });
                
                cart_total_price += product[0].precio_producto * item.product_quantity;
            }
        }

        let newCart = await shoppingcartModel.createCart({ building_id, user_id, cart_total_price, product_list });

        if (!newCart) {
            throw new Error("No se pudo crear el nuevo carrito.");
        }

        return {
            newCartId: Number(newCart),
            building_id,
            user_id,
            cart_total_price,
            product_list
        }
    }
}

export default ShoppingCartService;