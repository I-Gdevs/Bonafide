import RecipeService from "../services/recipe.service.js";

const recipeService = new RecipeService();

class RecipeController {
    
    async createRecipe(req, res) {
        try {
            let { product_id, recipe_description, recipe_preparation_time, recipe_stock_list } = req.body;

            let newRecipe = await recipeService.createRecipe({ product_id, recipe_description, recipe_preparation_time, recipe_stock_list });

            return res.status(201).json({
                message: "Nueva receta creada correctamente.",
                newRecipe
            });
        } catch (error) {
            console.log("Error al intentar crear nueva receta: ", error.message);
            
            return res.status(500).json({
                error: "Error interno al intentar crear nueva receta."
            });
        }
    }

    async getRecipes(req, res) {
        try {
            let recipeList = await recipeService.getRecipe();

            return res.status(200).json({
                message: "Lista de recetas buscada exitosamente.",
                recipe_list: recipeList
            });
        } catch (error) {
            console.log("Error al intentar buscar la lista de recetas: ", error.message);

            if (error.message.includes("No hay")) {
                return res.status(404).json({
                    error: error.message
                });
            }

            return res.status(500.).json({
                error: "Error interno al intentar buscar la lista de recetas."
            });
        }
    }

    async updateRecipe(req, res) {
        try {
            let { recipe_id, new_recipe_description, new_recipe_preparation_time, new_recipe_stock } = req.body;

            let updatedRecipe = await recipeService.updateRecipe({ recipe_id, new_recipe_description, new_recipe_preparation_time, new_recipe_stock });

            return res.status(200).json({
                message: "Receta actualizada correctamente.",
                updatedRecipe
            });
        } catch (error) {
            console.error("Error al intentar actualizar los datos de la receta: ", error.message);

            if (error.message.includes("faltantes")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar buscar la lista de recetas."
            });
        }
    }

    async deleteRecipe(req, res) {
        try {
            let { recipe_id } = req.body;

            let deletedRecipe = await recipeService.deleteRecipe({ recipe_id });

            return res.status(200).json({
                message: "Receta eliminada correctamente.",
                deletedRecipe
            });
        } catch (error) {
            console.error("Eror al intentar eliminar la receta: ", error.message);

            if (error.message.includes("ID")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar eliminar la receta."
            });
        }
    }
}

export default RecipeController;