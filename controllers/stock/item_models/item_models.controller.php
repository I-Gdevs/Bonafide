<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $itemModelsList = [];

    $response = callApi("POST", "/stock/template");

    if ($response["ok"]) {
        $itemModelsList = $response["data"]["stock_templates_list"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de stock: " . ($response["data"]['error'] ?? 'Error de API');
    }
?>