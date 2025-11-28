import BuildingService from "../services/building.service.js";

const buildingService = new BuildingService();

class BuildingController {

    async createBuilding(req, res) {
        try {
            let { building_address, building_employees, building_manager } = req.body;

            let newBuilding = await buildingService.createBuilding({ building_address, building_employees, building_manager });

            return res.status(201).json({
                message: "Local creado correctamente.",
                newBuilding: newBuilding
            });
        } catch (error) {
            console.error("Error al crear nuevo local: ", error.message);

            return res.status(500).json({
                error: "Error interno al crear nuevo local."
            });
        }
    }
}

export default BuildingController;