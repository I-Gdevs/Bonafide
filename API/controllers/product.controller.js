import ProductService from "../services/product.service.js";

const productService = new ProductService();

class ProductController {

    async createProduct(req, res) {
        try {
            let { product_name, product_price, is_combo_bool, product_category } = req.body;

            let newProduct = await productService.createProduct({ product_name, product_price, is_combo_bool, product_category });

            return res.status(200).json({
                message: "Nuevo producto creado correctamente.",
                newProduct
            });
        } catch (error) {
            console.log("Error al intentar crear un nuevo producto: ", error.message);

            return res.status(500).json({
                error: "Error interno al intentar crear un nuevo producto."
            });
        }
    }

    async getProducts(req, res) {
        try {
            let productList = await productService.getProducts();

            return res.status(200).json({
                product_list: productList
            });

        } catch (error) {
            console.error("Error al buscar la lista de productos: ", error.message);

            if (error.message.includes("No hay")) {
                return res.status(404).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar buscar la lista de productos."
            });
        }
    }

    async updateProduct(req, res) {
        try {
            let { product_id, new_product_name, new_product_price, new_product_category } = req.body;

            let updatedProduct = await productService.updateProduct({ product_id, new_product_name, new_product_price, new_product_category });

            return res.status(200).json({
                message: "Producto actualizado correctamente",
                updatedProduct
            });
        } catch (error) {
            console.error("Error al intentar actualizar datos del producto: ", error.message);

            if (error.message.includes("faltantes")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar actualizar los datos del producto."
            });
        }
    }

    async deleteProduct(req, res) {
        try {
            let { product_id } = req.body;

            let deletedProduct = await productService.deleteProduct({ product_id });

            return res.status(200).json({
                message: "Producto eliminado correctamente.",
                deletedProduct
            });

        } catch (error) {
            console.error("Error al intentar eliminar el producto: ", error.message);

            if (error.message.includes("ID")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar eliminar el producto."
            });
        }
    }
}

export default ProductController;