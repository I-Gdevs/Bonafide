<?php
    session_start();

    define('BASE_PATH', dirname(__DIR__));
    define('BASE_URL', 'http://localhost/Bonafide/public');

    require_once BASE_PATH . '/config/config.php';

    require_once BASE_PATH . '/helpers/api.helper.php';

    $route = isset($_GET['route']) ? $_GET['route'] : 'home';

    $route = rtrim($route, '/') ;

    switch ($route) {
        // Inicio
        case 'home':
            $view_file = BASE_PATH . '/views/home.php';
            break;


        // Inicio de sesión y registro de usuario
        case 'login':
            require BASE_PATH . '/controllers/login.controller.php';
            
            $view_file = BASE_PATH . '/views/login/login.php';
            break;

        case 'signup':
            $view_file = BASE_PATH . '/views/register/register.php';
            break;

        case 'forgottenPassword':
            $view_file = BASE_PATH . '/views/forgottenPassword/forgottenPassword.php';
            break;


        // Módulos de stock
        case 'stock':
            require BASE_PATH . '/controllers/stock/stock.controller.php';

            $view_file = BASE_PATH . '/views/stock/stock.php';
            break;
                
        case 'stock/movements':
            $view_file = BASE_PATH . '/views/stock/movements.php';
            break;

        case 'stock/item-models':
            $view_file = BASE_PATH . '/views/stock/item_models.php';
            break;

        case 'stock/providers':
            require BASE_PATH . '/controllers/stock/provider.controller.php';

            $view_file = BASE_PATH . '/views/stock/providers.php';
            break;
        
        case 'stock/buildings':
            require BASE_PATH . '/controllers/stock/building.controller.php';

            $view_file = BASE_PATH . '/views/stock/buildings.php';
            break;

            
        // Presentacion
        case 'presentacion':
            $view_file = BASE_PATH . '/views/errors/presentacion.php';
            break;

        // Pedir
        case 'pedir':
            $view_file = BASE_PATH . '/views/pedir/pedir.php';
            break;

        // Nosotros
        case 'nosotros':
            $view_file = BASE_PATH . '/views/nosotros/nosotros.php';
            break;

        // Comandas
        case 'comandas':
            $view_file = BASE_PATH . '/views/comandas/comandas.php';
            break;
        
        // Productos
        case 'productos':
            $view_file = BASE_PATH . '/views/productos/productos.php';
            break;

        // Administracion
        case 'administracion':
            $view_file = BASE_PATH . '/views/administracion/administracion.php';
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