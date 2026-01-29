<?php
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $buildingsResponseError = null;
    $buildings = [];

    $buildingsResponse = callApi("GET", "/buildings");

    if ($buildingsResponse["ok"]) {
        $buildings = $buildingsResponse["res"]["data"] ?? [];
    } else {
        $buildingsResponseError = "No se pudo buscar la lista de locales: " . ($buildingsResponse["res"]["error"] ?? "Error de API");
    }

    $usersResponseError = null;
    $users = [];
    
    $usersResponse = callApi("GET", "/user", ["role" => 3]);
    
    if($usersResponse["ok"]) {
        $users = $usersResponse["res"]["data"] ?? [];
    } else {
        $usersResponseError = "No se pudo buscar la lista de empleados: " . ($usersResponse["res"]["error"] ?? "Error de API");
    }

?>