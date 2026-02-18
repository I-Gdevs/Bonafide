import ProductService from "./product.service.js";
import * as responseBuilder from "../../helpers/response.helper.js";

const productService = new ProductService();

class ProductController {

    async createProduct(req, res) {
        try {
            let { product_name,
                product_price,
                is_combo_bool,
                product_category,
                product_description,
                product_image_url,
                product_ingredients
            } = req.body;

            let newProductData = await productService.createProduct({
                product_name,
                product_price,
                is_combo_bool,
                product_category,
                product_description,
                product_image_url,
                product_ingredients
            });

            return responseBuilder.success(req, res, 201, newProductData, "Producto y receta creados correctamente.");
        } catch (error) {
            console.log("[Controller] Error al intentar crear un nuevo producto: ", error);

            return responseBuilder.error(req, res, error);
        }
    }

    async getProducts(req, res) {
        try {
            let { product_id }  = req.query;

            let productList = await productService.getProducts({ product_id });
            return responseBuilder.success(req, res, 200, productList);

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
            let { product_id } = req.params;

            let { new_product_name,
                new_product_price,
                is_combo_bool,
                new_product_category,
                new_product_description,
                new_product_image_url,
                new_product_ingredients
            } = req.body;


            let updatedProduct = await productService.updateProduct({
                product_id,
                new_product_name,
                new_product_price,
                is_combo_bool,
                new_product_category,
                new_product_description,
                new_product_image_url,
                new_product_ingredients
            });

            return responseBuilder.success(req, res, 200, updatedProduct, "Producto actualizado correctamente.");

        } catch (error) {
            console.log("[Controller] Error al intentar actualizar producto: ", error);
            return responseBuilder.error(req, res, error);
        }
    }

    async deleteProduct(req, res) {
        try {
            let { product_id } = req.params;

            let deletedProduct = await productService.deleteProduct({ product_id });

            return responseBuilder.success(req, res, 200, deletedProduct, "Producto eliminado correctamente.");

        } catch (error) {
            console.error(error);
            
            return responseBuilder.error(req, res, {statusCode:500, message: "Error al eliminar producto"});

        }
    }
}

export default ProductController;