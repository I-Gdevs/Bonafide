import dbPool from "../database/db.js";

class UserModel {

    async createUser({user_name, user_email, user_dni, user_password, user_role}) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();
            
            let dbQuery = "INSERT INTO usuarios (nombre_usuario, correo_usuario, dni_usuario, contraseña_usuario, id_rol) VALUES (?, ?, ?, ?, ?)";

            dbConnection.beginTransaction();

            result[0] = await dbConnection.query(dbQuery, [
                user_name,
                user_email,
                user_dni,
                user_password,
                user_role
            ]);

            await dbConnection.commit();

        } catch (error) {
            
            if (dbConnection) {
                await dbConnection.rollback();
            }

        } finally {

            if (dbConnection) {
                await dbConnection.release()
            }

            return result[0];
        }
    }

    async findUser({user, user_email}) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();
            
            let dbQuery = "SELECT * FROM usuarios WHERE 1=1";
            let dbParams = [];
            
            if (user) {
                dbQuery += " AND id_usuario = (?)";
                dbParams.push(user);
            }

            if (user_email) {
                dbQuery += " AND correo_usuario = (?)";
                dbParams.push(user_email);
            }

            if (dbParams.length === 0) {
                throw new Error("No se pasó ningún parámetro { user, user_email }");
            } else {
                result = await dbConnection.query(dbQuery, dbParams);
            }
            
        } catch (error) {
            console.error(error);
            
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }
            return result[0];

        }
    }
}

export default UserModel;