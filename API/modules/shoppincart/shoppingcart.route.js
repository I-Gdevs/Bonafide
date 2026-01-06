import { Router } from "express";
import { verifyToken } from "../../middlewares/auth.middleware.js";
import ShoppingCartController from "./shoppingcart.controller.js";

const shoppingcartRouter = Router();
const shoppingcartController = new ShoppingCartController();

shoppingcartRouter.post("/create", verifyToken, (req, res) => shoppingcartController.createCart(req, res));

export default shoppingcartRouter;