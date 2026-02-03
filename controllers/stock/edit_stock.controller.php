<?php
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST["id"];
        $cantidad_minima = $_POST["cantidad_minima_stock"];


        $editStockMinimumQuantity = callApi("PATCH", "/stock" . "/" . $id, [
            "new_stock_minimum_quantity" => $cantidad_minima
        ]);

        if($editStockMinimumQuantity["ok"]) {
            setFlash("Cantidad mínima de stock modificada correctamente.", "success");
        } else {
            $error = $editStockMinimumQuantity["res"]["error"] ?? "Error al modificar cantidad mínima de stock.";
            setFlash($error, "error");
        }

        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . BASE_URL . "/stock");
        }
        
        exit;
    }
?>