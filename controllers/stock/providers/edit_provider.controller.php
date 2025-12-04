<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $cuit = $_POST['cuit'];
        $detalle = $_POST['detalle'];


        $response = callApi("PATCH", "/provider/update", [
            "provider_id" => $id,
            "new_provider_name" => $nombre,
            "new_provider_detail" => $detalle
        ]);

        if($response['ok']) {
            header("Location: " . BASE_URL . "/stock/providers?success=editado");
            exit;
        } else {
            $error = urlencode($response['data']['error'] ?? "Error al actualizar los datos .");

            header("Location: " . BASE_URL . "/stock/providers?error=" . $error);

            exit;
        }
    }
?>