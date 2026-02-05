<?php
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];

        $destroyItemTemplateResponse = callApi("DELETE", "/item-templates" . "/" . $id . "?force=true");

        if($destroyItemTemplateResponse["ok"]) {
            setFlash("Modelo de artículo destruído definitivamente", "success");
        } else {
            $error = urlencode($destroyItemTemplateResponse["res"]["error"] ?? "Error al destruir modelo de artículo.");
            setFlash($error, "error");
        }
        
        // Devuelve al mismo sitio en el que estaba el usuario
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . BASE_URL . "/stock/item-templates");
        }

        exit;
    }
?>