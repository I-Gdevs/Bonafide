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

    async findProvider({ provider_id, provider_name, provider_cuit }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM proveedores WHERE 1=1";
            let dbParams = [];

            if (provider_id) {
                dbQuery += " AND id_proveedor = (?)";
                dbParams.push(provider_id);
            }

            if (provider_name) {
                dbQuery += " AND nombre_proveedor = (?)";
                dbParams.push(provider_name);
            }

            if (provider_cuit) {
                dbQuery += " AND cuit_proveedor = (?)";
                dbParams.push(provider_cuit);
            }

            if (dbParams.length === 0) {
                throw new Error("No se pasó ningún parámetro { name_provider, cuit_provider }. No se puede buscar un proveedor.");
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

    async getAllProviders() {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "SELECT * FROM proveedores;";

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
            return result;
        }
    }

    async updateProvider({ provider_id, new_provider_name, new_provider_detail }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbUpdates = [];
            let dbParams = [];

            if (new_provider_name) {
                dbUpdates.push("nombre_proveedor = (?)");
                dbParams.push(new_provider_name);
            }
            
            if (new_provider_detail) {
                dbUpdates.push("detalle_proveedor = (?)");
                dbParams.push(new_provider_detail);
            }

            dbParams.push(provider_id);

            if (dbUpdates.length === 0) {
                throw new Error("No se pasó ningún parámetro { name_provider, detail_provider }. No se puede editar proveedor.");
            }
            
            let dbQuery = `UPDATE proveedores SET ${dbUpdates.join(", ")} WHERE id_proveedor = (?)`;

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
            return result[0];
        }
    }

    async deleteProvider({ provider_id }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "UPDATE proveedores SET proveedor_desactivado_bool = 1 WHERE id_proveedor = (?);"

            result = await dbConnection.query(dbQuery, provider_id);

        } catch (error) {
            console.error(error);

            if (dbConnection) {
                dbConnection.release();
            }
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result[0];
        }
    }
}

export default ProviderModel;