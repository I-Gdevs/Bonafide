<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $products = [];

    $productsResponse = callApi("GET", "/products");

    if ($productsResponse["ok"]) {
        $products = $productsResponse["res"]["product_list"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de productos: " . ($productsResponse["res"]["error"] ?? 'Error de API');
    }

?>