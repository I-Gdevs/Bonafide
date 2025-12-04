<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $buildingList = [];

    $response = callApi("POST", "/building/list");

    if ($response["ok"]) {
        $buildingList = $response["data"]["buildings_list"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de stock: " . ($response["data"]['error'] ?? 'Error de API');
    }
?>