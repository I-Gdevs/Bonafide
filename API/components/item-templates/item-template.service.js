import ItemTemplateModel from "./item-template.model.js";
import { errorHandler } from "../../helpers/error.helper.js";

const itemTemplateModel = new ItemTemplateModel();

class ItemTemplateService {

    async getItemTemplates(filters) {

        let itemTemplates = [];
        
        itemTemplates = await itemTemplateModel.getItemTemplates(filters);

        if (itemTemplates.length === 0) {
            errorHandler.notFound("No hay ningún modelo de artículo cargado");
        }
        
        return itemTemplates;
    }

    async createItemTemplate({ item_template_name, item_template_unit }) {

        if (!item_template_name || !item_template_unit) {
            errorHandler.badRequest("No se pudo crear: Faltan parámetros.");
        }
        
        let newItemTemplate = await itemTemplateModel.createItemTemplate({ item_template_name, item_template_unit });

        return await this.getItemTemplates({ "item_template_id": newItemTemplate.insertId});
    }

    async updateItemTemplate({ item_template_id, new_item_template_name, new_item_template_unit, new_item_template_disabled_bool }) {

        if (!item_template_id) {
            errorHandler.badRequest("No se pudo actualizar: Faltan parámetros.");
        }
        if (!new_item_template_name && !new_item_template_unit && new_item_template_disabled_bool === undefined) {
            errorHandler.badRequest("No se pudo actualizar: Faltan parámetros.");
        }

        let updatedItemTemplate = await itemTemplateModel.updateItemTemplate({ item_template_id, new_item_template_name, new_item_template_unit, new_item_template_disabled_bool });

        if (updatedItemTemplate.affectedRows === 0) {
            errorHandler.notFound("No se pudo modificar: No se encontró modelo de artículo en la base de datos.");
        }

        return await this.getItemTemplates({ item_template_id });
    }
    
    async deleteItemTemplate({ item_template_id }) {

        if (!item_template_id) {
            errorHandler.badRequest("No se pudo eliminar: Faltan parámetros.");
        }

        let deletedItemTemplate = await itemTemplateModel.deleteItemTemplate({ item_template_id });

        if (deletedItemTemplate.affectedRows === 0) {
            errorHandler.notFound("No se pudo eliminar: No se encontró el modelo de artículo en la base de datos.");
        }

        return await this.getItemTemplates({ item_template_id });
    }
    
    async destroyItemTemplate({ item_template_id }) {

        if (!item_template_id) {
            errorHandler.badRequest("No se pudo eliminar definitivamente: Faltan parámetros.");
        }

        try {
            let destroyedItemTemplate = await itemTemplateModel.destroyItemTemplate({ item_template_id });
            
            if (destroyedItemTemplate.affectedRows === 0) {
                errorHandler.notFound("No se pudo eliminar definitivamente: No existe en la base de datos");
            }
    
            return destroyedItemTemplate.affectedRows;

        } catch (error) {
            if (error.code === "ER_ROW_IS_REFERENCED_2" || error.errno === 1451) {
                errorHandler.conflict("No se pudo eliminar definitivamente: Este modelo de artículo tiene historial.");
            }
        }
    }
}

export default ItemTemplateService;