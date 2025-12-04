<?php
    $error = null;
    $success_msg = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];


        $response = callApi("PATCH", "/stock/update", [
            "stock_id" => $id,
            "new_stock_name" => $nombre
        ]);

        if($response['ok']) {
            header("Location: " . BASE_URL . "/stock/item-models?success=editado");
            exit;
        } else {
            $error = urlencode($response['data']['error'] ?? "Error al actualizar modelo de artículo.");

            header("Location: " . BASE_URL . "/stock/item-models?error=" . $errorMsg);

            exit;
        }

    }
?>