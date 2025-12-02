import dbPool from "../database/db.js";

class ShoppingCartModel {

    async createCart({ building_id, user_id, cart_total_price, product_list }) {
        let dbConnection;
        let cart_id;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let dbCartQuery = "INSERT INTO carrito_de_compra (id_local, id_usuario, precio_cdc) VALUES (?, ?, ?);";

            let newCart = await dbConnection.query(dbCartQuery, [
                building_id,
                user_id,
                cart_total_price
            ]);
            
            cart_id = newCart.insertId;

            let dbCartProductsQuery = "INSERT INTO producto_en_cdc (id_carrito, id_producto, cantidad_producto) VALUES (?, ?, ?)";

            for (let item of product_list) {

                await dbConnection.query(dbCartProductsQuery, [
                    cart_id,
                    item.product_id,
                    item.product_quantity
                ]);
            }

            await dbConnection.commit();

        } catch (error) {
            console.error("No se pudo crear el nuevo carrito: ", error.message);

            if (dbConnection) {
                dbConnection.rollback();
            }

            cart_id = 0

        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return cart_id;
        }
    }
}

export default ShoppingCartModel;