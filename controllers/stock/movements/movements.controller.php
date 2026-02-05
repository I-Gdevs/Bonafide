<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $movimientos = [];

    $filters = $_GET;
    if(isset($filters["route"])) {
        unset($filters["route"]);
    }

    if (!isset($filters["item_template_disabled"])) {
        $filters["item_template_disabled"] = 0;
    }

    if (isset($filters["item_template_disabled"]) && $filters["item_template_disabled"] === "" ) {
        unset($fitlers["item_template_disabled"]);
    }

    $stockMovementsResponse = callApi("GET", "/stock/movements", $filters);

    if ($stockMovementsResponse["ok"]) {
        $movimientos = $stockMovementsResponse["res"]["data"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de movimientos: " . ($stockMovementsResponse["res"]["error"] ?? 'Error de API');
    }

?>