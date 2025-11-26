import mariadb from "mariadb";
import "dotenv/config";

const dbPool = mariadb.createPool({
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    user: process.env.DB_USER,
    password: process.env.DB_PASS,
    database: process.env.DB_NAME,
    connectionLimit: 10
});

export const checkDatabaseConnection = async () => {
    let connection;
    try {
        connection = await dbPool.getConnection();
        console.log("Conectado");
    } catch (error) {
        console.error(error, "Se re pudrio");
    } finally {
        if (connection) {
            connection.release();
        }
    }
};

export default dbPool;