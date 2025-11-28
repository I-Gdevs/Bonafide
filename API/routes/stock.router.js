import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import StockController from "../controllers/stock.controller.js";

const stockRouter = Router();
const stockController = new StockController();

stockRouter.post("/create", verifyToken, (req, res) => stockController.createStock(req, res));
stockRouter.post("/list", verifyToken, (req, res) => stockController.getStock(req, res));
stockRouter.patch("/update", verifyToken, (req, res) => stockController.updateStock(req, res));
stockRouter.delete("/delete", verifyToken, (req, res) => stockController.deleteStock(req, res));

export default stockRouter;