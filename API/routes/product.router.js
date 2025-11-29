import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import ProductController from "../controllers/product.controller.js";

const productRouter = Router();
const productController = new ProductController();

productRouter.post("/create", verifyToken, (req, res) => productController.createProduct(req, res));
productRouter.post("/list", verifyToken, (req, res) => productController.getProducts(req, res));
productRouter.patch("/update", verifyToken, (req, res) => productController.updateProduct(req, res));
productRouter.delete("/delete", verifyToken, (req, res) => productController.deleteProduct(req, res));

export default productRouter;