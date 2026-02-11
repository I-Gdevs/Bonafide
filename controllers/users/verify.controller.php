<?php
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

    if ($response["res"]["success"]) {
        $verificado = true;
        $success = $response["res"]["message"] ?? "Tu cuenta ha sido activada correctamente.";
    } else {
        $verificado = false;
        $error = $response["res"]["error"] ?? "El enlace ha caducado o es inválido.";
    }
?>