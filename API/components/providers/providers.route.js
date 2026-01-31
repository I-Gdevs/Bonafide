import { Router } from 'express';
import { verifyToken } from "../../middlewares/auth.middleware.js";
import ProviderController from './providers.controller.js';

const providerRouter = Router();
const providerController = new ProviderController();

providerRouter.get("/", verifyToken, (req, res) => providerController.getProviders(req, res));
providerRouter.post("/", verifyToken, (req, res) => providerController.createProvider(req, res));
providerRouter.patch("/:provider_id", verifyToken, (req, res) => providerController.updateProvider(req, res));
providerRouter.delete("/:provider_id", verifyToken, (req, res) => providerController.deleteProvider(req, res));

export default providerRouter;