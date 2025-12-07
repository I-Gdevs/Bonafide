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


        // Stock
        case 'stock':
            require BASE_PATH . '/controllers/stock/stock.controller.php';

            $view_file = BASE_PATH . '/views/stock/stock.php';
            break;
        
        
        // Movimientos de stock
        case 'stock/movements':
            $view_file = BASE_PATH . '/views/stock/movements.php';
            break;


        // Modelos de artículos
        case 'stock/item-models':
            require BASE_PATH . '/controllers/stock/item_models/item_models.controller.php';

            $view_file = BASE_PATH . '/views/stock/item_models.php';
            break;
        
        case 'stock/item-models/create':
            require BASE_PATH . '/controllers/stock/item_models/create_item_models.controller.php';
            break;

        case 'stock/item-models/edit':
            require BASE_PATH . '/controllers/stock/item_models/edit_item_models.controller.php';
            break;


        // Proveedores
        case 'stock/providers':
            require BASE_PATH . '/controllers/stock/providers/provider.controller.php';

            $view_file = BASE_PATH . '/views/stock/providers.php';
            break;
        
        case 'stock/providers/create':
            require BASE_PATH . '/controllers/stock/providers/create_provider.controller.php';
            break;
        
        case 'stock/providers/edit':
            require BASE_PATH . '/controllers/stock/providers/edit_provider.controller.php';
            break;
        
        case 'stock/buildings':
            require BASE_PATH . '/controllers/stock/building.controller.php';

            $view_file = BASE_PATH . '/views/stock/buildings.php';
            break;

            
        // Presentacion
        case 'presentacion':
            $view_file = BASE_PATH . '/views/errors/presentacion.php';
            break;

        // SeleccionarLocal
        case 'seleccionarLocal':
            $view_file = BASE_PATH . '/views/pedir/seleccionarLocal.php';
            break;
        
        // Pedir_Pedir
        case 'pedir':
            $view_file = BASE_PATH . '/views/pedir/pedir.php';
            break;

        // Pagar
        case 'pagar':
            $view_file = BASE_PATH . '/views/pedir/pago/pagar.php';
            break;

        // Añadir Receta
        case 'añadirReceta':
            $view_file = BASE_PATH . '/views/productos/añadirReceta/añadirReceta.php';
            break;

        // Ver Receta
        case 'receta':
            $view_file = BASE_PATH . '/views/productos/receta.php';
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

        // Perfil
        case 'perfil':
            $view_file = BASE_PATH . '/views/perfil/perfil.php';
            break;
        
        // pdf
        case 'pdf':
            $view_file = BASE_PATH . '/views/pdfviewer.php';
            break;

        // cartel1
        case 'cartel1':
            $view_file = BASE_PATH . '/views/publicidad/cartel1.php';
            break;

        // ticket
        case 'ticket':
            $view_file = BASE_PATH . '/views/emails/email_Ticket.html';
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