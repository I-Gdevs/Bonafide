<?php
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];


        $editItemTemplateResponse = callApi("PATCH", "/item-templates" . "/" . $id, [
            "new_item_template_name" => $nombre
        ]);

        if($editItemTemplateResponse["ok"]) {
            setFlash("Modelo  de artículo actualizado", "success");
        } else {
            $error = urlencode($editItemTemplateResponse["res"]["error"] ?? "Error al actualizar modelo de artículo.");
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