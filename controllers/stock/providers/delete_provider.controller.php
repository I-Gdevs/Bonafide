<?php
    $error = null;
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $building = null;

        $id = $_POST["id"];
        
        $deleteProviderResponse = callApi("DELETE", "/providers" . "/" . $id);

        if ($deleteProviderResponse["ok"]) {
            header("Location: " . BASE_URL . "/stock/providers?success=Proveedor eliminado correctamente.");
            exit;
        } else {
            $error = urlencode($deleteProviderResponse["res"]["error"] ?? "Error al eliminar proveedor.");

            header("Location: " . BASE_URL . "/stock/providers?error=" . $error);
        }
    }
    
?>