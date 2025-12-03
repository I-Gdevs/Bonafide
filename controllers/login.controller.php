<?php
    $error = null;
    $success_msg = null;

    if (isset($_GET['newSignup']) && $_GET['newSignup'] === 'success') {
        $success_msg = "¡Cuenta creada con éxito! Ahora inicia sesión con tus credenciales.";
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $response = callApi("POST", "/user/login", [
            "user_email" => $user_email,
            "user_password" => $user_password
        ]);

        if ($response['ok']) {
            $_SESSION['token'] = $response['data']['token'];
            $_SESSION['user'] = $response['data']['user'];
            $_SESSION['user_logged'] = true;

            header("Location: " . BASE_URL . "/home");
            exit;

        } else {
            $error = $response['data']['error'] ?? "Usuario o contraseña incorrectos";
        }
    }
?>