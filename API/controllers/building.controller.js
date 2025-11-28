import BuildingService from "../services/building.service.js";

const buildingService = new BuildingService();

class BuildingController {

    async createBuilding(req, res) {
        try {
            let { building_address, building_employees, building_manager } = req.body;

            let newBuilding = await buildingService.createBuilding({ building_address, building_employees, building_manager });

            return res.status(201).json({
                message: "Nuevo local creado correctamente.",
                newBuilding: newBuilding
            });
        } catch (error) {
            console.error("Error al crear nuevo local: ", error.message);

            return res.status(500).json({
                error: "Error interno al crear nuevo local."
            });
        }
    }

    async getBuildings(req, res) {
        try {
            let buildingsList = await buildingService.getBuildings();

            return res.status(200).json({
                buildings_list: buildingsList
            });
        } catch (error) {
            console.error("Error al buscar la lista de locales: ", error.message);

            if (error.message.includes("No hay")) {
                return res.status(404).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al buscar la lista de locales."
            });
        }
    }

    async updateBuilding(req, res) {
        try {
            let { building_id, new_building_address, new_building_employees, new_building_manager } = req.body;

            let updatedBuilding = await buildingService.updateBuilding({ building_id, new_building_address, new_building_employees, new_building_manager });

            return res.status(200).json({
                message: "Local actualizado correctamente.",
                updatedBuilding
            });
        } catch (error) {
            console.error("Error al intentar actualizar datos del local: ", error.message);

            if (error.message.includes("faltantes")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar actualizar datos del local."
            });
        }
    }

    async deleteBuilding(req, res) {
        try {
            let { building_id } = req.body;

            let deletedBuilding = await buildingService.deleteBuilding({ building_id });

            return res.status(200).json({
                message: "Local eliminado correctamente.",
                deletedBuilding
            });
        } catch (error) {
            console.error("Error al intentar eliminar local: ", error.message);

            if (error.message.includes("ID")) {
                return res.status(400).json({
                    error: error.message
                });
            }

            return res.status(500).json({
                error: "Error interno al intentar eliminar el local."
            });
        }
    }
}

export default BuildingController;