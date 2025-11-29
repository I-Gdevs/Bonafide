import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import StockController from "../controllers/stock.controller.js";

const stockRouter = Router();
const stockController = new StockController();

stockRouter.post("/create", verifyToken, (req, res) => stockController.createStock(req, res));
stockRouter.post("/template", verifyToken, (req, res) => stockController.getStockTemplate(req, res));
stockRouter.patch("/update", verifyToken, (req, res) => stockController.updateStock(req, res));
stockRouter.delete("/delete", verifyToken, (req, res) => stockController.deleteStock(req, res));

stockRouter.post("/move", verifyToken, (req, res) => stockController.moveStock(req, res));
stockRouter.post("/amount", verifyToken, (req, res) => stockController.getStockAmount(req, res));


export default stockRouter;