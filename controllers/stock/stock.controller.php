<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $stockList = [];
    $locales = [];

    $response = callApi("POST", "/stock/amount");

    if ($response["ok"]) {
        $stockList = $response["data"]["stock_list"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de stock: " . ($response["data"]['error'] ?? 'Error de API');
    }

?>