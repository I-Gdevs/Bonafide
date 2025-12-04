<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $nombre = $_POST['nombre'];
        $unidad = $_POST['unidad'];

        $response = callApi("POST", "/stock/create", [
            "stock_name" => $nombre,
            "stock_measurement_unit" => $unidad
        ]);

        if($response['ok']) {
            header("Location: " . BASE_URL . "/stock/item-models?success=creado");
            exit;
        } else {
            $error = urlencode($response['data']['error'] ?? "Error al tratar de crear nuevo modelo de artículo.");

            header("Location: " . BASE_URL . "/stock/item-models?error=" . $error);

            exit;
        }
    }
?>