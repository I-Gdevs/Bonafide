<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $nombreFinalImagen = "default.png";

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
            $archivo = $_FILES["imagen"];
            $extension = pathinfo($archivo["name"], PATHINFO_EXTENSION);

            $extensionesPermitidas = ["jpg", "jpeg", "png"];

            if (in_array(strtolower($extension), $extensionesPermitidas)) {
                $nombreFinalImagen = "prod_" . uniqid() . "." . $extension;
                $rutaDestino = BASE_PATH . "/public/img/productos/" . $nombreFinalImagen;

                if (!move_uploaded_file($archivo["tmp_name"], $rutaDestino)) {
                    $nombreFinalImagen = "default.png";
                }
            }
        }

        $ingredientes = [];
        if (isset($_POST["ingredientes_json"]) && !empty($_POST["ingredientes_json"])) {
            $ingredientes = json_decode($_POST["ingredientes_json"], true);
        }

        $datosParaApi = [
            "product_name" => $_POST["nombre"],
            "product_price" => $_POST["precio"],
            "product_category" => $_POST["categoria"],
            "product_description" => $_POST["descripcion"],
            "product_image_url" => $nombreFinalImagen,
            "product_ingredients" => $ingredientes
        ];

        $createProductResponse = callApi("POST", "/products", $datosParaApi);

        if($createProductResponse["ok"]) {
            setFlash("Producto creado correctamente", "success");
        } else {
            $error = urlencode($createProductResponse["res"]["error"] ?? "Error al tratar de crear nuevo producto.");
            setFlash($error, "error");
        }
        
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . BASE_URL . "/products");
        }

        exit;
    }
?>