import UserService from "../services/user.service.js";

const userService = new UserService();

class UserController {

    async createUser(req, res) {
        try {
            let { user_name, user_email, user_dni, user_password, user_role } = req.body;

            let newUser = await userService.createUser({ user_name, user_email, user_dni, user_password, user_role });

            console.log(newUser);

            return res.status(201).json({
                message: "Usuario creado correctamente",
                newUser: newUser
            });

        } catch (error) {
            console.error("Error al crear usuario: ", error.message);
        
            if (error.message.includes("ya está registrado")) {
                return  res.status(409).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al crear usuario"
            });
        }
        
    }

    async loginUser(req, res) {
        try {
            let { user_email, user_password } = req.body;

            let result = await userService.loginUser({ user_email, user_password });

            return res.status(200).json({
                message: "Login exitoso.",
                token: result.token,
                user: result.user
            });

        } catch (error) {

            console.error("Error durante el login: ", error.message);

            if (error.message === "Credenciales inválidas.") {
                // Efectivamente hubo un error de contraseña errónea
                return res.status(401).json({
                    error: error.message
                });
            }

            if (error.message.includes("encontró")) {
                // Se sabe que se ingresó una credencial no registrada, pero no se le informa eso al usuario
                return res.status(401).json({
                    error: "Usuario no registrado o credenciales inválidas."
                });
            }

            return res.status(500).json({
                // Otro error
                error: "Error interno del servidor."
            });
        }
    }
}

export default UserController;