<?php
    $token = $_GET["token"] ?? null;

    $verificado = false;
    $mensaje = "";

    if (!$token) {
        $mensaje = "No se ha proporcionado un código de verificación.";
    } else {
        $response = callApi("POST", "/users/verify", ["verification_token" => $token]);
    }

    if (isset($respuesta["ok"])) {
        $verificado = true;
        $mensaje = $resputa["res"]["message"] ?? "Tu cuenta ha sido activada correctamente.";
    } else {
        $verificado = false;
        $mensaje = $respeusta["res"]["error"] ?? "El enlace ha caducado o es inválido."
    }

?>