import dbPool from "../database/db.js";

class ProviderModel {

    async createProvider({ provider_name, provider_cuit, provider_detail }) {
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

    async findProvider({ provider_name, provider_cuit }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM proveedores WHERE 1=1";
            let dbParams = [];

            if (provider_name) {
                dbQuery += " AND nombre_proveedor (?)";
                dbParams.push(provider_name);
            }

            if (provider_cuit) {
                dbQuery += " AND cuit_proveedor = (?)";
                dbParams.push(provider_cuit);
            }

            if (dbParams.length === 0) {
                throw new Error("No se pasó ningún parámetro { name_provider, cuit_provider }. No se puede buscar un proveedor.");
            } else {
                result = await dbConnection.query(dbQuery, dbParams);
            }

        } catch (error) {
            if (dbConnection) {
                await dbConnection.release();
            }
            console.error(error);

        } finally {
            if (dbConnection) {
                await dbConnection.release();
            }

            return result[0];
        }
    }
}

export default ProviderModel;