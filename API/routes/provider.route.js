import { Router } from 'express';
import { verifyToken } from "../middlewares/auth.middleware.js";
import ProviderController from '../controllers/provider.controller.js';

const providerRouter = Router();
const providerController = new ProviderController();

providerRouter.post("/create", verifyToken, (req, res) => providerController.createProvider(req, res));

export default providerRouter;