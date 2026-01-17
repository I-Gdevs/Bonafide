<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $buildingList = [];

    $response = callApi("GET", "/buildings");

    if ($response["ok"]) {
        $buildingList = $response["res"]["data"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de stock: " . ($response["res"]['error'] ?? 'Error de API');
    }
?>