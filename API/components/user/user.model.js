import dbPool from "../../database/db.js";

class UserModel {

    async createUser({ user_fullname, user_email, user_dni, user_password, user_role, user_nickname, verification_token }) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();
            
            let dbQuery = "INSERT INTO usuarios (nombre_usuario, correo_usuario, dni_usuario, contraseña_usuario, id_rol, nick_usuario, token_verificacion) VALUES (?, ?, ?, ?, ?, ?, ?)";

            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, [
                user_fullname,
                user_email,
                user_dni,
                user_password,
                user_role,
                user_nickname,
                verification_token
            ]);

            await dbConnection.commit();

        } catch (error) {
            console.error(error)

            if (dbConnection) {
                await dbConnection.rollback();
            }

            throw error;

        } finally {

            if (dbConnection) {
                await dbConnection.release();
            }
        }
    }

    async activateUser(user_id) {
        let dbConnection;
        let result;

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = "UPDATE usuarios SET verificado_bool = 1 WHERE id_usuario = (?)";
            
            await dbConnection.beginTransaction();

            result = await dbConnection.query(dbQuery, user_id);

            await dbConnection.commit();
            
        } catch (error) {
            console.error(error);

            if (dbConnection) {
                dbConnection.rollback();
            }

            throw error;
        } finally {
            if (dbConnection) {
                dbConnection.release();
            }

            return result;
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
            }

            result = await dbConnection.query(dbQuery, dbParams);

        } catch (error) {
            console.error(error);
            
        } finally {

            if (dbConnection) {
                dbConnection.release();
            }

            return result[0];
        }
    }

    async getUsers(filters) {
        let dbConnection;
        let result = [];

        try {
            dbConnection = await dbPool.getConnection();

            let dbQuery = `
                SELECT
                    id_usuario AS id,
                    nombre_usuario AS name,
                    nick_usuario AS nickname,
                    correo_usuario AS email,
                    dni_usuario AS dni,
                    id_rol AS role,
                    token_verificacion,
                    contraseña_usuario AS password
                FROM usuarios
                WHERE 1=1
            `;

            let dbParams = [];

            if (filters.role) {
                dbQuery += " AND id_rol = (?)";
                dbParams.push(filters.role);
            }

            if (filters.email) {
                dbQuery += " AND correo_usuario = (?)";
                dbParams.push(filters.email);
            }

            if (filters.nickname) {
                dbQuery += " AND nick_usuario LIKE (?)";
                dbParams.push(`%${filters.nickname}`);
            }

            if (filters.verification_token) {
                dbQuery += " AND token_verificacion = (?)";
                dbParams.push(filters.verification_token);
            }

            result = await dbConnection.query(dbQuery, dbParams);

        } catch (error) {
            console.error("Error en getUsers:", error);

            throw error;

        } finally {
            if (dbConnection) {
                dbConnection.release();
            }

            return result;
        }
    }
}

export default UserModel;