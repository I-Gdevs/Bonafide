import { Router } from "express";

import userRouter from "../modules/user/user.route.js";
import providerRouter from "../modules/provider/provider.route.js";
import buildingRouter from "../modules/building/building.route.js";
import stockRouter from "../modules/stock/stock.router.js";
import productRouter from "../modules/product/product.route.js";
import recipeRouter from "../modules/recipe/recipe.route.js";
import shoppingcartRouter from "../modules/shoppincart/shoppingcart.route.js";
import salesRouter from "../modules/sales/sales.route.js";

const router = Router();

router.use("/user", userRouter);
router.use("/provider", providerRouter);
router.use("/building", buildingRouter);
router.use("/stock", stockRouter);
router.use("/product", productRouter);
router.use("/recipe", recipeRouter);
router.use("/shopping-cart", shoppingcartRouter);
router.use("/sales", salesRouter);

export default router;