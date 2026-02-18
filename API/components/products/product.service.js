import ProductModel from "./product.model.js";
import { errorHandler } from "../../helpers/error.helper.js";

const productModel = new ProductModel();

class ProductService {

    async createProduct({ product_name, product_price, is_combo_bool, product_category, product_description, product_image_url, product_ingredients }) {

        if (!product_name || !product_price || !product_category) {
            errorHandler.badRequest("El nombre, precio y categoría son obligatorios.");
        }

        if (parseFloat(product_price) < 0) {
            errorHandler.badRequest("El precio del producto no puede ser negativo.");
        }

        if (product_ingredients && !Array.isArray(product_ingredients)) {
            errorHandler.badRequest("El formato de los ingredientes es inválido.");
        }
        
        let result = await productModel.createProduct({
            product_name,
            product_price,
            is_combo_bool,
            product_category,
            product_description,
            product_image_url,
            product_ingredients
        });

        return {
            newProductId: Number(result.insertId),
            product_name,
            product_ingredients_count: product_ingredients ? product_ingredients.length : 0
        };
    }

    async getProducts({ product_id }) {
        let products = [];

        products = await productModel.getProducts({ product_id });

        if (products.length === 0) {
            throw new Error("No hay ningún modelo de stock cargado.");
        }
        return products;
    }

    async updateProduct({ product_id, new_product_name, new_product_price, new_product_category }) {

        if (!product_id) {
            throw new Error("No se puede actualizar el producto. Datos faltanttes. No se proporcionó ningún ID de producto.");
        }

        if (!new_product_name && !new_product_price && !new_product_category) {
            throw new Error("No se puede actualizar producto. Datos faltantes. No se proporcionó ningún cambio { new_product_name, new_product_price, new_product_category }.");
        }

        let updatedProduct = await productModel.updateProduct({ product_id, new_product_name, new_product_price, new_product_category });

        if (updatedProduct.affectedRows != 1) {
            throw new Error("No se pudo actualizar el producto.");
        }

        return updatedProduct = { product_id, new_product_name, new_product_price, new_product_category }
    }

    async deleteProduct({ product_id }) {

        if (!productModel) {
            throw new Error("No se puede eliminar producto. Datos faltantes. No se proporcionó ningún ID de producto.");
        }

        let deletedProduct = await productModel.deleteProduct({ product_id });

        if (deletedProduct.affectedRows != 1) {
            throw new Error("No se pudo eliminar el producto.");
        }

        return { product_id };
    }
}

export default ProductService;