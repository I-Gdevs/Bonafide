<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $providers = [];

    $providersResponse = callApi("GET", "/providers");

    if ($providersResponse["res"]["success"]) {
        $providers = $providersResponse["res"]["data"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de proveedores: " . ($providersResponse["res"]["error"] ?? 'Error de API');
    }
?>