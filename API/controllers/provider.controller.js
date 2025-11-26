import ProviderService from "../services/provider.service.js";

const providerService = new ProviderService();

class ProviderController {
    
    async createProvider(req, res) {
        try {
            let { provider_name, provider_cuit, provider_detail } = req.body;
    
            let newProvider = await providerService.createProvider({ provider_name, provider_cuit, provider_detail });
    
            // A VER SI SE CREÓ BIEN EL NUEVO PROVEEDOR CHEEE
            console.log(newProvider);
    
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
    
}

export default ProviderController;