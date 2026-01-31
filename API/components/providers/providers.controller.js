import ProviderService from "./providers.service.js";
import * as responseBuilder from "../../helpers/response.helper.js";

const providerService = new ProviderService();

class ProviderController {

    async getProviders(req, res) {
        try {
            let filters = req.query;

            let providersList = await providerService.getProviders(filters);

            return responseBuilder.success(req, res, 200, providersList);

        } catch (error) {
            console.error("Error al buscar la lista de proveedores: ", error.message);

            if (error.message.includes("No hay")) {
                return responseBuilder.error(req, res, 404, "No se encontró ningún proveedor.");
            } else {
                return responseBuilder.error(req, res)
            }
        }
    }
    
    async createProvider(req, res) {
        try {
            let { provider_name, provider_cuit, provider_detail } = req.body;
    
            let newProvider = await providerService.createProvider({ provider_name, provider_cuit, provider_detail });
            
            return responseBuilder.success(req, res, 200, newProvider);

        } catch (error) {
            console.error("Error al crear nuevo proveedor: ", error.message);

            if (error.message.includes("CUIT")) {
                return responseBuilder.error(req, res, 409, error.message);
            } else {
                return responseBuilder.error(req, res);
            }
        }
    }

    async updateProvider(req, res) {
        try {
            let provider_id = req.params.provider_id;

            let { new_provider_name, new_provider_detail } = req.body;

            let updatedProvider = await providerService.updateProvider({ provider_id, new_provider_name, new_provider_detail });

            return responseBuilder.success(req, res, 200, updatedProvider);

        } catch (error) {
            console.error("Error al intentar actualizar datos del proveedor: ", error.message);
            
            if (error.message.includes("ID")) {
                return responseBuilder.error(req, res, 400, error.message);
            } else {
                return responseBuilder.error(req, res);
            }
        }
    }

    async deleteProvider(req, res) {
        try {
            let provider_id = req.params.provider_id;

            let deletedProvider = await providerService.deleteProvider({ provider_id });

            return responseBuilder.success(req, res, 200, deletedProvider);

        } catch (error) {
            console.error("Error al intentar eliminar proveedor: ", error.message);

            if (error.message.includes("ID")) {
                return responseBuilder.error(req, res, 400, error.message);
            } else {
                return responseBuilder.error(req, res);
            }
        }
    }
}

export default ProviderController;