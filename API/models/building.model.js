import dbPool from "../database/db.js";

class BuildingModel {

    async createBuilding({ building_address, building_employees, building_manager }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "INSERT INTO locales (direccion_local, empleados_local, id_usuario) VALUES (?, ?, ?);";

            dbConnection.beginTransaction();

            result[0] = await dbConnection.query(dbQuery, [
                building_address,
                building_employees,
                building_manager
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
            return result[0];
        }
    }

    async getBuildings() {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM locales;";

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

    async updateBuilding({ building_id, new_building_address, new_building_employees, new_building_manager }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbUpdates = [];
            let dbParams = [];

            if (new_building_address) {
                dbUpdates.push("direccion_local = (?)");
                dbParams.push(new_building_address);
            }
            
            if (new_building_employees) {
                dbUpdates.push("empleados_local = (?)");
                dbParams.push(new_building_employees);
            }
            
            if (new_building_manager) {
                dbUpdates.push("id_usuario = (?)");
                dbParams.push(new_building_manager);
            }

            dbParams.push(building_id);

            let dbQuery = `UPDATE locales SET ${dbUpdates.join(", ")} WHERE id_local = (?)`

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, dbParams);

            await dbConnection.commit();

        } catch (error) {
            console.error(error);
            
            if (dbConnection) {
                dbConnection.release();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            console.log(result);
            return result;
        }
    }

    async deleteBuilding({ building_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "UPDATE locales SET local_desactivado_bool = 1 WHERE id_local = (?);"

            result = await dbConnection.query(dbQuery, building_id);

        } catch (error) {
            console.error(error);

            if (dbConnection) {
                dbConnection.release();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result;
        }
    }
}

export default BuildingModel;