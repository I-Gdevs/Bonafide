import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import SalesController from "../controllers/sales.controller.js";

const salesRouter = Router();
const salesController = new SalesController();

salesRouter.post("/create", verifyToken, (req, res) => salesController.createSale(req, res));
salesRouter.post("/list", verifyToken, (req, res) => salesController.getSales(req, res));
salesRouter.patch("/update", verifyToken, (req, res) => salesController.updateSale(req, res));

export default salesRouter;