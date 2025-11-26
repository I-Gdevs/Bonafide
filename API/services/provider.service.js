import ProviderModel from "../models/provider.model.js";

const providerModel = new ProviderModel();

class ProviderService {
    
    async createProvider({ provider_name, provider_cuit, provider_detail }) {
        
        let doesProviderAlreadyExist = await providerModel.findProvider({ provider_cuit });
        
        if (doesProviderAlreadyExist) {
            throw new Error("No se puede crear nuevo proveedor. El CUIT ya está registrado.");
        }

        let newProvider = await providerModel.createProvider({ provider_name, provider_cuit, provider_detail });

        return { newProviderId: Number(newProvider.insertId), provider_name, provider_cuit, provider_detail };
    }

}

export default ProviderService;