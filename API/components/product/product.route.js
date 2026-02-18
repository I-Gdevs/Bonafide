import { Router } from "express";
import { verifyToken } from "../../middlewares/auth.middleware.js";
import ProductController from "./product.controller.js";

const productRouter = Router();
const productController = new ProductController();

productRouter.get("", verifyToken, (req, res) => productController.getProducts(req, res));
productRouter.post("", verifyToken, (req, res) => productController.createProduct(req, res));
productRouter.patch("/:product_id", verifyToken, (req, res) => productController.updateProduct(req, res));
productRouter.delete("/:product_id", verifyToken, (req, res) => productController.deleteProduct(req, res));

export default productRouter;