import { Router } from "express";
import { verifyToken } from "../../middlewares/auth.middleware.js";
import StockController from "./stock.controller.js";

const stockRouter = Router();
const stockController = new StockController();

stockRouter.get("", verifyToken, (req, res) => stockController.getStock(req, res));
stockRouter.post("", verifyToken, (req, res) => stockController.createMovement(req, res));
stockRouter.patch("/:stock_id", verifyToken, (req, res) => stockController.updateStockMinQuantity(req, res));

export default stockRouter;