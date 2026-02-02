<?php
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];

        $restoreItemTemplateResponse = callApi("PATCH", "/item-templates" . "/" . $id, [
            "new_item_template_disabled_bool" => "0"
        ]);

        if($restoreItemTemplateResponse["ok"]) {
            setFlash("Modelo de artículo restaurado correctamente", "success");
        } else {
            $error = urlencode($restoreItemTemplateResponse["res"]["error"] ?? "Error al actualizar modelo de artículo.");
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