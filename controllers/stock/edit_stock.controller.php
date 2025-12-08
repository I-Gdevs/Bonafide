<?php
    $error = null;
    $success_msg = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];
        $cantidad_minima= $_POST['cantidad_minima'];


        $response = callApi("PATCH", "/stock/update", [
            "stock_id" => $id,
            "new_stock_minimum_ammount" => $cantidad_minima
        ]);

        if($response['ok']) {
            header("Location: " . BASE_URL . "/stock?success=editado");
            exit;
        } else {
            $error = urlencode($response['data']['error'] ?? "Error al actualizar modelo de artículo.");

            header("Location: " . BASE_URL . "/stock?error=" . $error);

            exit;
        }

    }
?>