import { Router } from "express";

import userRouter from "../components/user/user.route.js";
import providerRouter from "../components/providers/providers.route.js";
import buildingRouter from "../components/buildings/buildings.route.js";
import itemTemplateRouter from "../components/item-templates/item-template.route.js";
import stockRouter from "../components/stock/stock.router.js";
import productRouter from "../components/products/product.route.js";
import recipeRouter from "../components/recipe/recipe.route.js";
import shoppingcartRouter from "../components/shoppingcart/shoppingcart.route.js";
import salesRouter from "../components/sales/sales.route.js";

const router = Router();

router.use("/users", userRouter);
router.use("/providers", providerRouter);
router.use("/buildings", buildingRouter);
router.use("/item-templates", itemTemplateRouter);
router.use("/stock", stockRouter);
router.use("/products", productRouter);
router.use("/recipe", recipeRouter);
router.use("/shopping-cart", shoppingcartRouter);
router.use("/sales", salesRouter);

export default router;