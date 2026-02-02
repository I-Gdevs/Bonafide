<?php
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $id = $_POST['id'];

        $deleteItemTemplateResponse = callApi("DELETE", "/item-templates" . "/" . $id);

        if($deleteItemTemplateResponse["ok"]) {
            setFlash("Modelo de artículo eliminado",  "success");
        } else {
            $error = urlencode($deleteItemTemplateResponse["res"]["error"] ?? "Error al eliminar modelo de artículo.");
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