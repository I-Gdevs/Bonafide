<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $idProducto = $_POST["id_eliminar"];

        if (!empty($idProducto)) {
            $response = callApi("DELETE", "/products" . "/" . $idProducto);
            if ($response["ok"]) {
                setFlash("Producto eliminado correctamente.", "success");
            } else {
                $errorMsg = $response["res"]["error"] ?? "Error al eliminar.";
                setFlash($errorMsg, "error");
            }
        }

        // Redirigimos siempre al listado
        header("Location: " . BASE_URL . "/products");
        exit;
    }
?>