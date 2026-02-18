<?php
    $error = null;

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $idProducto = $_POST["id"];
        $nombreFinalImagen = $_POST["imagen_actual"] ?? "default.png";

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
            
            $archivo = $_FILES["imagen"];
            $extension = pathinfo($archivo["name"], PATHINFO_EXTENSION);
            $extensionesPermitidas = ["jpg", "jpeg", "png"];

            if (in_array(strtolower($extension), $extensionesPermitidas)) {
                $nuevoNombre = "prod_" . strtolower(str_replace(" ", "_", $_POST["nombre"])) . "_" . uniqid() . "." . $extension;
                $rutaDestino = BASE_PATH . "/public/img/productos/" . $nuevoNombre;

                if (move_uploaded_file($archivo["tmp_name"], $rutaDestino)) {
                    $nombreFinalImagen = $nuevoNombre;
                }
            }
        }

        $ingredientes = [];
        if (isset($_POST["ingredientes_json"]) && !empty($_POST["ingredientes_json"])) {
            $ingredientes = json_decode($_POST["ingredientes_json"], true);
        }

        $datosParaApi = [
            "new_product_name" => $_POST["nombre"],
            "new_product_price" => $_POST["precio"],
            "is_combo_bool" => 0,
            "new_product_category" => $_POST["categoria"],
            "new_product_description" => $_POST["descripcion"],
            "new_product_image_url" => $nombreFinalImagen,
            "new_product_ingredients" => $ingredientes
        ];

        $updateProductResponse = callApi("PATCH", "/products/" . $idProducto, $datosParaApi);

        if($updateProductResponse["ok"]) {
            setFlash("Producto actualizado correctamente", "success");
        } else {
            $errorMsg = $updateProductResponse["res"]["error"] ?? "Error al actualizar el producto.";
            setFlash($errorMsg, "error");
        }
        
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . BASE_URL . "/products");
        } else {
            header("Location: " . BASE_URL . "/products");
        }

        exit;
    }
?>