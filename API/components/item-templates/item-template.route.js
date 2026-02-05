import { Router } from "express";
import { verifyToken } from "../../middlewares/auth.middleware.js";
import ItemTemplateController from "./item-template.controller.js";

const itemTemplateRouter = Router();
const itemTemplateController = new ItemTemplateController();

itemTemplateRouter.get("", verifyToken, (req, res) => itemTemplateController.getItemTemplates(req, res));
itemTemplateRouter.post("", verifyToken, (req, res) => itemTemplateController.createItemTemplate(req, res));
itemTemplateRouter.patch("/:item_template_id", (req, res) => itemTemplateController.updateItemTemplate(req, res));
itemTemplateRouter.delete("/:item_template_id", (req, res) => itemTemplateController.deleteItemTemplate(req, res));

export default itemTemplateRouter;