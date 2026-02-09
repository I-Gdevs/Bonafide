import UserModel from "./user.model.js";
import bcrypt from "bcrypt";
import jwt from "jsonwebtoken";

const cucharadasDeSalsa = 10;
const userModel = new UserModel();

class UserService {

    async createUser({ user_fullname, user_email, user_dni, user_password, user_role, user_nickname }) {
        
        let doesUserAlreadyExist = await userModel.findUser({ user_email });
        
        if (doesUserAlreadyExist) {
            throw new Error("El correo electrónico ya está registrado.");
        }
        
        let encryptedPassword = await bcrypt.hash(user_password, cucharadasDeSalsa);

        if (!user_role) {
            user_role = 3;
        }
    
        await userModel.createUser({ user_fullname, user_email, user_dni, user_password: encryptedPassword, user_role, user_nickname });

        return this.getUsers({nickname: user_nickname});
    }

    async loginUser({ user_email, user_password }) {

        let [user] = await userModel.getUsers({ email: user_email });

        let authUser = await bcrypt.compare(user_password, user.password);
        
        if (!authUser) {
            throw new Error("Credenciales inválidas.");
        }

        let payload = {
            user_id: Number(user.id),
            user_fullname: user.name,
            user_nickname: user.nickname,
            user_email: user.email,
            user_dni: user.dni
        }

        let token = jwt.sign(payload, process.env.JWT_SECRET, {
            expiresIn: '72h'
        });


        return { token, user: payload };
    }

    async getUsers(filters) {
        return await userModel.getUsers(filters);
    }
}

export default UserService;