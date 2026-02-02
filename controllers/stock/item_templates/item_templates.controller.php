<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $error = null;
    $itemTemplates = [];

    $filters = $_GET;
    if (!isset($filters["item_template_disabled"])) {
        $filters["item_template_disabled"] = 0;
    }

    if (isset($filters["item_template_disabled"]) && $filters["item_template_disabled"] === "" ) {
        unset($fitlers["item_template_disabled"]);
    }

    $itemTemplatesResponse = callApi("GET", "/item-templates", $filters);

    if ($itemTemplatesResponse["ok"]) {
        $itemTemplates = $itemTemplatesResponse["res"]["data"] ?? [];
    } else {
        $error ="No se pudo buscar la lista de modelos de artículos: " . ($itemTemplatesResponse["res"]["error"] ?? 'Error de API');
    }

?>