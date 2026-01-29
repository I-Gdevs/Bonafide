<?php
    $error = null;
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $building = null;

        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $cantidad_empleados = $_POST["cantidad_empleados"];
        $encargado = $_POST["encargado"];

        $editBuildingResponse = callApi("PATCH", "/buildings" . "/" . $id , [
            "new_building_name" => $nombre,
            "new_building_address" => $direccion,
            "new_building_employees" => $cantidad_empleados,
            "new_building_manager" => $encargado
        ]);

        if ($editBuildingResponse["ok"]) {
            header("Location: " . BASE_URL . "/stock/buildings?success=editado");
            exit;
        } else {
            $error = urlencode($editBuildingResponse["res"]["error"] ?? "Error al editar local.");

            header("Location: " . BASE_URL . "/stock/buildings?error=" . $error);
        }
    }
?>