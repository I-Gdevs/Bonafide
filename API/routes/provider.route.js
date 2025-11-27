import { Router } from 'express';
import { verifyToken } from "../middlewares/auth.middleware.js";
import ProviderController from '../controllers/provider.controller.js';

const providerRouter = Router();
const providerController = new ProviderController();

providerRouter.post("/create", verifyToken, (req, res) => providerController.createProvider(req, res));
providerRouter.post("/list", verifyToken, (req, res) => providerController.getAllProviders(req, res));
providerRouter.patch("/update", verifyToken, (req, res) => providerController.updateProvider(req, res));
providerRouter.delete("/delete", verifyToken, (req, res) => providerController.deleteProvider(req, res));

export default providerRouter;