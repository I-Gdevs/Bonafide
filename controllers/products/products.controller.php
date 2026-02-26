<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $products = [];

    // Por defecto, la ruta base (para los empleados / administración)
    $endpoint = "/products";

    // Si el usuario es un cliente y ya eligió sucursal, le sumamos el parámetro
    if (isset($_SESSION['id_local_preferido'])) {
        $endpoint .= "?building_id=" . urlencode($_SESSION['id_local_preferido']);
    }

    // Llamamos a la API. Los empleados llaman a "/products", los clientes a "/products?local_id=49"
    $productsResponse = callApi("GET", $endpoint);

    if ($productsResponse["ok"]) {
        $products = $productsResponse["res"]["data"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de productos: " . ($productsResponse["res"]["error"] ?? 'Error de API');
    }
?>