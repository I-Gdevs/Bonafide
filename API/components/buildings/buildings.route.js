import { Router } from "express";
import { verifyToken } from "../../middlewares/auth.middleware.js";
import BuildingController from "./buildings.controller.js";

const buildingRouter = Router();
const buildingController = new BuildingController();

buildingRouter.post("", verifyToken, (req, res) => buildingController.postBuilding(req, res));
buildingRouter.get("", verifyToken, (req, res) => buildingController.getBuildings(req, res));
buildingRouter.patch("/:id", verifyToken, (req, res) => buildingController.updateBuilding(req, res));
buildingRouter.delete("/:id", verifyToken, (req, res) => buildingController.deleteBuilding(req, res));


export default buildingRouter;