import ProviderService from "./provider.service.js";
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
                responseBuilder.error(req, res, 404, "No se encontró ningún proveedor.");
            } else {
                responseBuilder.error(req, res)
            }
        }
    }
    
    async createProvider(req, res) {
        try {
            let { provider_name, provider_cuit, provider_detail } = req.body;
    
            let newProvider = await providerService.createProvider({ provider_name, provider_cuit, provider_detail });
        
            return res.status(201).json({
                message: "Proveedor creado correctamente.",
                newProvider: newProvider
            });
        } catch (error) {
            console.error("Error al crear nuevo proveedor: ", error.message);

            if (error.message.includes("CUIT")) {
                return res.status(409).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al crear nuevo proveedor."
            });
        }
    }

    async updateProvider(req, res) {
        try {
            let { provider_id, new_provider_name, new_provider_detail } = req.body;

            let updatedProvider = await providerService.updateProvider({ provider_id, new_provider_name, new_provider_detail });

            return res.status(200).json({
                success: "Proveedor actualizado correctamente.",
                updatedProvider
            });
        } catch (error) {
            console.error("Error al intentar actualizar datos del proveedor: ", error.message);

            if (error.message.includes("ID")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar actualizar datos del proveedor."
            });
        }
    }

    async deleteProvider(req, res) {
        try {
            let { provider_id } = req.body;

            let deletedProvider = await providerService.deleteProvider({ provider_id });

            return res.status(200).json({
                message: "Proveedor eliminado correctamente.",
                deletedProvider
            });
        } catch (error) {
            console.error("Error al intentar eliminar proveedor: ", error.message);

            if (error.message.includes("ID")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar eliminar el proveedor."
            });
        }
    }
}

export default ProviderController;