import { Router } from "express";

import userRouter from "./user.route.js";
import providerRouter from "./provider.route.js";
import buildingRouter from "./building.route.js";
import stockRouter from "./stock.router.js";
import productRouter from "./product.route.js";
import recipeRouter from "./recipe.route.js";
import shoppingcartRouter from "./shoppingcart.route.js";

const router = Router();

router.use("/user", userRouter);
router.use("/provider", providerRouter);
router.use("/building", buildingRouter);
router.use("/stock", stockRouter);
router.use("/product", productRouter);
router.use("/recipe", recipeRouter);
router.use("/shopping-cart", shoppingcartRouter);

export default router;