import dbPool from "../database/db.js";

class BuildingModel {

    async createBuilding({ building_address, building_employees, building_manager }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "INSERT INTO proveedores (nombre_proveedor, cuit_proveedor, detalle_proveedor) VALUES (?, ?, ?);";

            dbConnection.beginTransaction();

            result[0] = await dbConnection.query(dbQuery, [
                provider_name,
                provider_cuit,
                provider_detail
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
}