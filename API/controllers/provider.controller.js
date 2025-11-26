import ProviderService from "../services/provider.service.js";

const providerService = new ProviderService();

class ProviderController {
    
    async createProvider({ provider_name, provider_cuit, provider_detail }) {
        let { provider_name, provider_cuit, provider_detal } = req.body;

        let newProvider = await providerService.createProvider({ provider_name, provider_cuit, provider_detail });

        // A VER SI SE CREÓ BIEN EL NUEVO PROVEEDOR CHEEE
        console.log(newProvider);

        return resizeBy.status(201).json({
            message: "Proveedor creado correctamente.",
            newProvider: newProvider
        });
    }
    
}