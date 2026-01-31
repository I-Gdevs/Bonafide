<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $nombre = $_POST['nombre'];
        $cuit = $_POST['cuit'];
        $detalle = $_POST['detalle'];


        $createProviderResponse = callApi("POST", "/providers", [
            "provider_name" => $nombre,
            "provider_cuit" => $cuit,
            "provider_detail" => $detalle
        ]);

        if($createProviderResponse["ok"]) {
            header("Location: " . BASE_URL . "/stock/providers?success=creado");
            exit;
        } else {
            $error = urlencode($createProviderResponse["res"]["error"] ?? "Error al actualizar los datos .");

            header("Location: " . BASE_URL . "/stock/providers?error=" . $error);

            exit;
        }
    }
?>