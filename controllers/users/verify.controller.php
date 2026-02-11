<?php
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $verification_token = $_GET["verification_token"] ?? null;
        
        $verificado = false;
        $success = "";
        $error = "";
    
        if (!$verification_token) {
            $error = "No se ha proporcionado un código de verificación.";
        } else {
            $response = callApi("POST", "/users/verify", [
                "verification_token" => $verification_token
            ]);
        }
    
        if (isset($response["res"]["success"]) && $response["res"]["sucess"]) {
            $verificado = true;
            $success = $response["res"]["message"] ?? "Tu cuenta ha sido activada correctamente.";
        } else {
            $verificado = false;
            $error = $response["res"]["error"] ?? "El enlace ha caducado o es inválido.";
        }
    }
?>