<?php
    $error = null;

    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $cuit = $_POST["cuit"];
        $detalle = $_POST["detalle"];


        $editProviderResponse = callApi("PATCH", "/providers" . "/" . $id, [
            "new_provider_name" => $nombre,
            "new_provider_detail" => $detalle
        ]);

        if($editProviderResponse["ok"]) {
            header("Location: " . BASE_URL . "/stock/providers?success=editado");
            exit;
        } else {
            $error = urlencode($editProviderResponse["res"]["message"] ?? "Error al actualizar los datos .");

            header("Location: " . BASE_URL . "/stock/providers?error=" . $error);

            exit;
        }
    }
?>