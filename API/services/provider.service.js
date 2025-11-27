import ProviderModel from "../models/provider.model.js";

const providerModel = new ProviderModel();

class ProviderService {
    
    async createProvider({ provider_name, provider_cuit, provider_detail }) {
        
        let doesProviderAlreadyExist = await providerModel.findProvider({ provider_cuit });

        if (doesProviderAlreadyExist.length > 0) {
            throw new Error("No se puede crear nuevo proveedor. El CUIT ya está registrado.");
        }

        let newProvider = await providerModel.createProvider({ provider_name, provider_cuit, provider_detail });
    
        return { newProviderId: Number(newProvider.insertId), provider_name, provider_cuit, provider_detail };
    }

    async getAllProviders() {

        let providers = [];

        providers = await providerModel.getAllProviders();

        if (providers.length === 0) {
            throw new Error("No hay ningún proveedor cargado.");
        }
        return providers;
    }

    async updateProvider({ provider_id, new_provider_name, new_provider_detail }) {

        let isIDValid = await providerModel.findProvider({ provider_id });

        if (isIDValid.length === 0) {
            throw new Error("No se puede actualizar proveedor. ID inválido.");
        }

        let updatedProvider = await providerModel.updateProvider({ provider_id, new_provider_name, new_provider_detail });
        
        if (updatedProvider) {
            console.log(updatedProvider);
            throw new Error("No se puede actualizar proveedor.");
        }

        return updatedProvider;
    }

    async deleteProvider({ provider_id }) {

        let isIDValid = await providerModel.findProvider({ provider_id });

        if (isIDValid.length === 0) {
            throw new Error("No se puede eliminar proveedor. ID inválido.");
        }

        let deletedProvider = await providerModel.deleteProvider({ provider_id });

        if (deletedProvider) {
            throw new Error("No se puede eliminar proveedor");
        }
        
        return deletedProvider;
    }
}

export default ProviderService;