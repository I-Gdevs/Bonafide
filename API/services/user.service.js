import UserModel from "../models/user.model.js";
import bcrypt from "bcrypt";
import jwt from "jsonwebtoken";

const cucharadasDeSalsa = 10;
const userModel = new UserModel();

class UserService {

    async createUser({user_name, user_email, user_dni, user_password, user_role}) {
        
        let doesUserAlreadyExist = await userModel.findUser({ user_email });
        
        if (doesUserAlreadyExist) {
            throw new Error("El correo electrónico ya está registrado.");
        }
        
        let encryptedPassword = await bcrypt.hash(user_password, cucharadasDeSalsa);

        if (!user_role) {
            user_role = 3;
        }
    
        let newUser = await userModel.createUser({ user_name, user_email, user_dni, user_password: encryptedPassword, user_role });

        return { newUserId: Number(newUser.insertId), user_name, user_email, user_role };
    }

    async loginUser({ user_email, user_password }) {

        let user = await userModel.findUser({ user_email })

        let authUser = await bcrypt.compare(user_password, user.contraseña_usuario);
        
        if (!authUser) {
            throw new Error("Credenciales inválidas.");
        }

        let payload = {
            user_id: Number(user.id_usuario),
            user_name: user.nombre_usuario,
            user_email,
            user_role: user.id_rol
        }

        let token = jwt.sign(payload, process.env.JWT_SECRET, {
            expiresIn: '8h'
        });

        return { token, user: payload };
    }
}

export default UserService;