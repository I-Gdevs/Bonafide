import { Router } from "express";
import { verifyToken } from "../../middlewares/auth.middleware.js";
import SalesController from "./sales.controller.js";

const salesRouter = Router();
const salesController = new SalesController();

salesRouter.get("", verifyToken, (req, res) => salesController.getSales(req, res));
salesRouter.post("", verifyToken, (req, res) => salesController.createSale(req, res));
salesRouter.get("/:id", verifyToken, (req, res) => salesController.getSaleById(req, res));
salesRouter.patch("/:sale_id", verifyToken, (req, res) => salesController.updateSale(req, res));

export default salesRouter;