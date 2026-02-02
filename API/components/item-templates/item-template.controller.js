import ItemTemplateService from "./item-template.service.js";
import * as responseBuilder from "../../helpers/response.helper.js";

const itemTemplateService = new ItemTemplateService();

class ItemTemplateController {

    async getItemTemplates(req, res) {
        try {
            let filters = req.query;

            let itemTemplates = await itemTemplateService.getItemTemplates(filters);

            return responseBuilder.success(req, res, 200, itemTemplates);
        } catch (error) {
            console.error("Error al buscar los modelos de artículos: ", error.message);

            if (error.message.includes("No hay")) {
                return responseBuilder.error(req, res, 404, error.message);
            } else {
                return responseBuilder.error(req, res);
            }
        }
    }

    async createItemTemplate(req, res) {
        try {
            let { item_template_name, item_template_unit } = req.body
            
            let newItemTemplate = await itemTemplateService.createItemTemplate({ item_template_name, item_template_unit });

            return responseBuilder.success(req, res, 200, newItemTemplate);

        } catch (error) {
            console.error("Error al crear un modelo de artículo nuevo: ", error.message);
            
            return responseBuilder.error(req, res, 500, error.message);
        }
    }

    async updateItemTemplate(req, res) {
        try {
            let item_template_id = req.params.item_template_id;
            let { new_item_template_name, new_item_template_unit, new_item_template_disabled_bool } = req.body;

            let updatedItemTemplate = await itemTemplateService.updateItemTemplate({ item_template_id, new_item_template_name, new_item_template_unit, new_item_template_disabled_bool });

            return responseBuilder.success(req, res, 200, updatedItemTemplate);

        } catch (error) {
            console.error("Error al modificar un modelo de artículo: ", error.message);

            return responseBuilder.error(req, res);
        }
    }
    
    async deleteItemTemplate(req, res) {
        try {
            let item_template_id = req.params.item_template_id;
            let force_delete = req.query.force;
            let deletedItemTemplate;

            if (force_delete) {
                deletedItemTemplate = await itemTemplateService.destroyItemTemplate({ item_template_id });
            } else {
                deletedItemTemplate = await itemTemplateService.deleteItemTemplate({ item_template_id });
            }

            return responseBuilder.success(req, res, 200, deletedItemTemplate);

        } catch (error) {
            return responseBuilder.error(req, res, error);
        }
    }
}

export default ItemTemplateController;