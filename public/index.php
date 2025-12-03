<?php
    define('BASE_PATH', dirname(__DIR__));
    define('BASE_URL', 'http://localhost/Bonafide/public');

    $route = isset($_GET['route']) ? $_GET['route'] : 'home';

    $route = rtrim($route, '/') ;

    switch ($route) {
        // Inicio
        case 'home':
            $view_file = BASE_PATH . '/views/home.php';
            break;


        // Inicio de sesión y registro de usuario
        case 'login':
            $view_file = BASE_PATH . '/views/login.php';
            break;

        case 'signup':
            $view_file = BASE_PATH . '/views/register.php';
            break;


        // Módulos de stock
        case 'stock':
            $view_file = BASE_PATH . '/views/stock/stock.php';
            break;

        
        // Caso por defecto - HTTP 404
        default:
            header("HTTP/1.0 404 Not Found");
            $view_file = BASE_PATH . '/views/errors/404pageNotFound.php';
            break;
    }

    if (file_exists($view_file)) {

        include $view_file;

    } else {
        header("HTTP/1.0 503 Service Unavailable");

        $maintenance_page = BASE_PATH . '/views/errors/maintenance.php';

        if (file_exists($maintenance_page)) {
            include $maintenance_page;
        } else {
            echo "Error: Vista no encontrada";
        }
    }
?>