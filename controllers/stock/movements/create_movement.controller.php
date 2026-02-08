<?php
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $building_id = $_POST["building_id"];
        $movement_reason = $_POST["movement_reason"];
        $receipt_type = $_POST["receipt_type"];
        $user_id = $_POST["user_id"];
        $provider_id = $_POST["provider_id"] ?? null;
        $items = $_POST["items"];
        $receipt_number = $_POST["receipt_number"] ?? null;

        if ($provider_id === "") {
            $provider_id = null;
        }

        $createStockMovementResponse = callApi("POST", "/stock/movements", [
            "building_id" => $building_id,
            "movement_reason" => $movement_reason,
            "receipt_type" => $receipt_type,
            "receipt_number" => $receipt_number,
            "user_id" => $user_id,
            "provider_id" => $provider_id,
            "items" => $items
        ]);

        if($createStockMovementResponse["ok"]) {
            setFlash("Movimiento registrado", "success");
        } else {
            $error = $createStockMovementResponse["res"]["error"] ?? "Error al crear nuevo movimiento de stock.";
            setFlash($error, "warning");
        }
        
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . BASE_URL . "/stock/movements");
        }

        exit;
    }
?>