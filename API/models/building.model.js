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
            console.log(result);
            return result[0];
        }
    }


}

export default BuildingModel;