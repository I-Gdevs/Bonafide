import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import BuildingController from "../controllers/building.manager.js";

const buildingRouter = Router();
const buildingController = new BuildingController();

buildingRouter.post("/create", verifyToken, (req, res) => buildingController.createBuilding(req, res));

export default buildingRouter;