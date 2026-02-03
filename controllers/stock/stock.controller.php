<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $stock = [];

    $filters = $_GET;
        
    if (isset($filters["route"])) {
        unset($filters["route"]);
    }

    if (isset($filters["building_id"]) && $filters["building_id"] === "") {
        unset($filters["building_id"]);
    }

    $stockResponse = callApi("GET", "/stock", $filters);

    if ($stockResponse["ok"]) {
        $stock = $stockResponse["res"]["data"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de stock: " . ($stockResponse["res"]["error"] ?? 'Error de API');
    }

    
?>