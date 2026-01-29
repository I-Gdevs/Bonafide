<?php
    $error = null;
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $newBuilding = null;

        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $cantidad_empleados = $_POST["cantidad_empleados"];
        $encargado = $_POST["encargado"];

        $createBuildingResponse = callApi("POST", "/buildings", [
            "building_name" => $nombre,
            "building_address" => $direccion,
            "building_employees" => $cantidad_empleados,
            "building_manager" => $encargado
        ]);

        if ($createBuildingResponse["ok"]) {
            header("Location: " . BASE_URL . "/stock/buildings?success=creado");
            exit;
        } else {
            $error = urlencode($createBuildingResponse["res"]["error"] ?? "Error al crear nuevo local.");

            header("Location: " . BASE_URL . "/stock/buildings?error=" . $error);
        }
    }

?>