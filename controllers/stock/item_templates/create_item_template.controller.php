<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $nombre = $_POST["nombre"];
        $unidad = $_POST["unidad"];

        $createItemTemplateResponse = callApi("POST", "/item-templates", [
            "item_template_name" => $nombre,
            "item_template_unit" => $unidad
        ]);

        if($createItemTemplateResponse["ok"]) {
            setFlash("Modelo de artículo creado correctamente", "success");
        } else {
            $error = urlencode($createItemTemplateResponse["res"]["error"] ?? "Error al tratar de crear nuevo modelo de artículo.");
            setFlash($error, "error");
        }
        
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . BASE_URL . "/stock/item-templates");
        }

        exit;
    }
?>