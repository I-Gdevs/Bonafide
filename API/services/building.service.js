import BuildingModel from "../models/building.model.js";

const buildingModel = new BuildingModel();

class BuildingService {

    async createBuilding({ building_address, building_employees, building_manager }) {
        
        let newBuilding = await buildingModel.createBuilding({ building_address, building_employees, building_manager });

        return { newBuildingId: Number(newBuilding.insertId), building_address, building_address, building_manager };
    }
}

export default BuildingService;