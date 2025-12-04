<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $nombre = $_POST['nombre'];
        $cuit = $_POST['cuit'];
        $detalle = $_POST['detalle'];


        $response = callApi("POST", "/provider/create", [
            "provider_name" => $nombre,
            "provider_cuit" => $cuit,
            "provider_detail" => $detalle
        ]);

        if($response['ok']) {
            header("Location: " . BASE_URL . "/stock/providers?success=creado");
            exit;
        } else {
            $error = urlencode($response['data']['error'] ?? "Error al actualizar los datos .");

            header("Location: " . BASE_URL . "/stock/providers?error=" . $error);

            exit;
        }
    }
?>