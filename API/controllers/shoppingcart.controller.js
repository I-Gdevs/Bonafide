import ShoppingCartService from "../services/shoppingcart.service.js";

const shoppingcartService = new ShoppingCartService();

class ShoppingCartController {

    async createCart(req, res) {
        try {
            let { building_id, user_id, product_list } = req.body;

            let newCart = await shoppingcartService.createCart({ building_id, user_id, product_list });

            return res.status(201).json({
                message: "Nuevo carrito de compras creado correctamente",
                newCart
            });
        } catch (error) {
            console.log("Error al intentar crear un nuevo carrito de compras: ", error.message);

            if (error.message.includes("faltantes")) {
                return res.status(404).json({
                    error: error.message
                });
            }
            
            return res.status(400).json({
                error: "Error interno al intentar crear un nuevo carrito de compras."
            });
        }
    }


}

export default ShoppingCartController;