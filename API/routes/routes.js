import { Router } from "express";

import userRouter from "../components/user/user.route.js";
import providerRouter from "../components/provider/provider.route.js";
import buildingRouter from "../components/buildings/buildings.route.js";
import stockRouter from "../components/stock/stock.router.js";
import productRouter from "../components/product/product.route.js";
import recipeRouter from "../components/recipe/recipe.route.js";
import shoppingcartRouter from "../components/shoppingcart/shoppingcart.route.js";
import salesRouter from "../components/sales/sales.route.js";

const router = Router();

router.use("/user", userRouter);
router.use("/provider", providerRouter);
router.use("/buildings", buildingRouter);
router.use("/stock", stockRouter);
router.use("/product", productRouter);
router.use("/recipe", recipeRouter);
router.use("/shopping-cart", shoppingcartRouter);
router.use("/sales", salesRouter);

export default router;