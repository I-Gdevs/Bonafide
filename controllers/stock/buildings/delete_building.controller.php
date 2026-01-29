<?php
    $error = null;
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $building = null;

        $id = $_POST["id"];
        
        $deleteBuildingResponse = callApi("DELETE", "/buildings" . "/" . $id);

        if ($deleteBuildingResponse["ok"]) {
            header("Location: " . BASE_URL . "/stock/buildings?success=Local eliminado correctamente.");
            exit;
        } else {
            $error = urlencode($deleteBuildingResponse["res"]["error"] ?? "Error al eliminar local.");

            header("Location: " . BASE_URL . "/stock/buildings?error=" . $error);
        }
    }
    
?>