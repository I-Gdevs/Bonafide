import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import RecipeController from "../controllers/recipe.controller.js";

const recipeRouter = Router();
const recipeController = new RecipeController();

recipeRouter.post("/create", verifyToken, (req, res) => recipeController.createRecipe(req, res));
recipeRouter.post("/list", verifyToken, (req, res) => recipeController.getRecipes(req, res));
recipeRouter.patch("/update", verifyToken, (req, res) => recipeController.updateRecipe(req, res));
recipeRouter.delete("/delete", verifyToken, (req, res) => recipeController.deleteRecipe(req, res));

export default recipeRouter;