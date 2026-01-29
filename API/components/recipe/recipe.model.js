import dbPool from "../../database/db.js";

class RecipeModel {

    async createRecipe({ product_id, recipe_description, recipe_preparation_time, recipe_stock_list }) {
        let dbConnection;
        let recipe_id;

        try {
            dbConnection = await dbPool.getConnection();
            await dbConnection.beginTransaction();

            let dbRecipeQuery = "INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta) VALUES (?, ?, ?);";

            let newRecipe = await dbConnection.query(dbRecipeQuery, [
                product_id,
                recipe_description,
                recipe_preparation_time
            ]);
            
            recipe_id = newRecipe.insertId;

            let dbIngredientsQuery = "INSERT INTO ingredientes_para_receta (id_receta, cantidad_para_receta, id_ing_mod) VALUES (?, ?, ?);";

            for (let item of recipe_stock_list) {
                
                await dbConnection.query(dbIngredientsQuery, [
                    recipe_id,
                    item.stock_quantity,
                    item.stock_id
                ]);
            }
            
            await dbConnection.commit();

        } catch (error) {
            console.error("No se pudo crear nueva receta: ", error.message);

            if (dbConnection) {
                dbConnection.rollback();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return recipe_id;
        }
    }

    async getRecipe() {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM recetas;";

            result = await dbConnection.query(dbQuery);

        } catch (error) {
            if (dbConnection) {
                await dbConnection.release();
            }
            console.error(error);

        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            console.log(result);
            return result;
        }

    }

    async updateRecipe({ recipe_id, new_recipe_description, new_recipe_preparation_time, new_recipe_stock }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbUpdates = [];
            let dbParams = [];

            if (new_recipe_description) {
                dbUpdates.push("descripcion_receta = (?)");
                dbParams.push(new_recipe_description);
            }

            if (new_recipe_preparation_time) {
                dbUpdates.push("tiempo_preparacion_receta = (?)");
                dbParams.push(new_recipe_preparation_time);
            }

            dbParams.push(recipe_id);

            let dbQuery = `UPDATE recetas SET ${dbUpdates.join(", ")} WHERE id_receta = (?);`;

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, dbParams);

            await dbConnection.commit();

        } catch (error) {
            console.error(error);
            
            if (dbConnection) {
                dbConnection.rollback();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result;
        }
    }

    async deleteRecipe({ recipe_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            dbConnection.beginTransaction();

            let dbQuery = "DELETE FROM recetas WHERE id_receta = (?);"

            result = await dbConnection.query(dbQuery, recipe_id);

            dbConnection.commit();

        } catch (error) {
            console.error(error);

            if (dbConnection) {
                dbConnection.rollback();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result;
        }
    }

}

export default RecipeModel;