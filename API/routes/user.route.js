import { Router } from 'express';
import { validateCreateUser, validateLoginuser } from '../middlewares/userValidator.middleware.js';
import UserController from '../controllers/user.controller.js';

const userRouter = Router();
const userController = new UserController();

userRouter.post("/create", validateCreateUser, (req, res) => userController.createUser(req, res));
userRouter.post("/login", validateLoginuser, (req, res) => userController.loginUser(req, res));

export default userRouter;