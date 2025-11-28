import { Router } from "express";
import { verifyToken } from "../middlewares/auth.middleware.js";
import BuildingController from "../controllers/building.controller.js";

const buildingRouter = Router();
const buildingController = new BuildingController();

buildingRouter.post("/create", verifyToken, (req, res) => buildingController.createBuilding(req, res));
buildingRouter.post("/list", verifyToken, (req, res) => buildingController.getBuildings(req, res));
buildingRouter.patch("/update", verifyToken, (req, res) => buildingController.updateBuilding(req, res));
buildingRouter.delete("/delete", verifyToken, (req, res) => buildingController.deleteBuilding(req, res));


export default buildingRouter;