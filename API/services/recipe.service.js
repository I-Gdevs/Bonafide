import RecipeModel from "../models/recipe.model.js";

const recipeModel = new RecipeModel();

class RecipeService {
    
    async createRecipe({ product_id, recipe_description, recipe_preparation_time, recipe_stock_list }) {
        
        let newRecipe = await recipeModel.createRecipe({ product_id, recipe_description, recipe_preparation_time, recipe_stock_list });

        return {
            newRecipeId: Number(newRecipe),
            recipe_description,
            recipe_preparation_time,
            recipe_stock_list
        };
    }

    async getRecipe() {
        let recipes = [];

        recipes = await recipeModel.getRecipe();

        if (recipes.length === 0) {
            throw new Error("No hay ninguna receta cargada.");
        }
        return recipes;
    }

    async updateRecipe({ recipe_id, new_recipe_description, new_recipe_preparation_time, new_recipe_stock }) {
        
        if (!recipe_id) {
            throw new Error("No se puede actualizar la receta. Datos faltanttes. No se proporcionó ningún ID de receta.");
        }

        if (!new_recipe_description && !new_recipe_preparation_time && !new_recipe_stock) {
            throw new Error("No se puede actualizar la receta. Datos faltantes. No se proporcionó ningún cambio { new_recipe_description, new_recipe_preparation_time, new_recipe_stock }.");
        }

        let updatedRecipe = await recipeModel.updateRecipe({ recipe_id, new_recipe_description, new_recipe_preparation_time, new_recipe_stock });

        if (updatedRecipe.affectedRows != 1) {
            throw new Error("No se pudo actualizar la receta.");
        }

        return updatedRecipe = {
            recipe_id,
            new_recipe_description,
            new_recipe_preparation_time,
            new_recipe_stock
        };
    }

    async deleteRecipe({ recipe_id }) {

        if (!recipe_id) {
            throw new Error("No se puede actualizar la receta. Datos faltanttes. No se proporcionó ningún ID de receta.");
        }

        let deletedRecipe = await recipeModel.deleteRecipe({ recipe_id });

        if (deletedRecipe.affectedRows != 1) {
            throw new Error("No se pudo eliminar la receta.");
        }

        return recipe_id;
    }

}

export default RecipeService;