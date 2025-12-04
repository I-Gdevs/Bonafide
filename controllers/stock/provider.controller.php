<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $providerList = [];

    $response = callApi("POST", "/provider/list");

    if ($response["ok"]) {
        $providerList = $response["data"]["providers_list"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de stock: " . ($response["data"]['error'] ?? 'Error de API');
    }
?>