import BuildingModel from "../models/building.model.js";

const buildingModel = new BuildingModel();

class BuildingService {

    async createBuilding({ building_address, building_employees, building_manager }) {
        
        let newBuilding = await buildingModel.createBuilding({ building_address, building_employees, building_manager });

        return { newBuildingId: Number(newBuilding.insertId), building_address, building_address, building_manager };
    }

    async getBuildings() {

        let buildings = [];

        if (buildings.length === 0) {
            throw new Error("No hay ningún local cargado.");
        }
        return buildings;
    }

    async updateBuilding({ building_id, new_building_address, new_building_employees, new_building_manager }) {
        
        if (!building_id) {
            throw new Error("No se puede actualizar local. Datos faltantes. No se proporcionó ningún ID de local.");
        }

        if (!new_building_address && !new_building_employees && !new_building_manager) {
            throw new Error("No se puede actualizar local. Datos faltantes. No se envió ningún cambio { new_building_address, new_building_employees, new_building_manager }.");
        }

        let updatedBuilding = await buildingModel.updateBuilding({ building_id, new_building_address, new_building_employees, new_building_manager });

        if (!updatedBuilding) {
            console.log(updatedBuilding);
            throw new Error("No se puede actualizar local.");
        }
        
        return updatedBuilding;
    }

    async deleteBuilding({ building_id }) {
        
        if (!building_id) {
            throw new Error("No se puede eliminar local. Datos faltantes. No se proporcionó ningún ID de local.");
        }

        let deletedBuilding = await buildingModel.deleteBuilding({ building_id });

        if (!deletedBuilding) {
            throw new Error("No se pudo eliminar el local.");
        }

        return deletedBuilding;
    }
}

export default BuildingService;