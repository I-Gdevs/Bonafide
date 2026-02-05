import dbPool from "../../database/db.js";

class ItemTemplateModel {

    async getItemTemplates(filters) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = `
                SELECT * FROM modelos_de_articulos
                WHERE 1=1
            `;

            let dbParams = [];

            if (filters.item_template_id) {
                dbQuery += " AND id_modelo_articulo = (?)";
                dbParams.push(filters.item_template_id);
            }

            if (filters.item_template_disabled) {
                dbQuery += " AND modelo_articulo_desactivado_bool = (?)";
                dbParams.push(filters.item_template_disabled);
            }

            if (dbParams.length === 0) {
                dbQuery += ";"
            }

            result = await dbConnection.query(dbQuery, dbParams);

        } catch (error) {
            if (dbConnection) {
                await dbConnection.release();
            }
            console.error(error);
        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            return result;
        }
    }

    async createItemTemplate({ item_template_name, item_template_unit }) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = `
                INSERT INTO modelos_de_articulos (nombre_modelo_articulo, unidad_medida_modelo_articulo)
                VALUES (?, ?);
            `;

            dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, [
                item_template_name,
                item_template_unit
            ]);

            await dbConnection.commit();
        } catch (error) {
            console.error(error);

            if (dbConnection) {
                await dbConnection.rollback();
            }
        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }
            return result;
        }
    }

    async updateItemTemplate({ item_template_id, new_item_template_name, new_item_template_unit, new_item_template_disabled_bool }) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();

            let dbUpdates = [];
            let dbParams = [];

            if (new_item_template_name) {
                dbUpdates.push("nombre_modelo_articulo = (?)");
                dbParams.push(new_item_template_name);
            }

            if (new_item_template_unit) {
                dbUpdates.push("unidad_medida_modelo_articulo = (?)");
                dbParams.push(new_item_template_unit);
            }
            
            if (new_item_template_disabled_bool) {
                dbUpdates.push("modelo_articulo_desactivado_bool = (?)");
                dbParams.push(new_item_template_disabled_bool);
            }

            dbParams.push(item_template_id);

            let dbQuery = `
                UPDATE modelos_de_articulos
                SET ${dbUpdates.join(", ")}
                WHERE id_modelo_articulo = (?);
            `;

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, dbParams);

            await dbConnection.commit();

        } catch (error) {
            console.log(error);

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

    async deleteItemTemplate({ item_template_id }) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = `
                UPDATE modelos_de_articulos
                SET modelo_articulo_desactivado_bool = 1
                WHERE id_modelo_articulo = (?);
            `;

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, item_template_id);

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

    async destroyItemTemplate({ item_template_id }) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = `
                DELETE FROM modelos_de_articulos
                WHERE id_modelo_articulo = (?);
            `;

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, item_template_id);

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
}

export default ItemTemplateModel;