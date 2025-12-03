<?php
// 1. Definir la ruta base para mayor seguridad y claridad
define('BASE_PATH', dirname(__DIR__)); // Apunta a la raíz del proyecto (fuera de public/)

// 2. Obtener la URI limpia, ignorando subcarpetas
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$script_name = $_SERVER['SCRIPT_NAME']; // /Bonafide/public/index.php
$script_dir = dirname($script_name);    // /Bonafide/public

// A. Normalizamos barras (Windows usa \ y Linux /)
// Esto es vital para que funcione en tu XAMPP/Windows
$script_dir = str_replace('\\', '/', $script_dir); 

// B. Restamos la carpeta base de la URI solicitada
// Si la URI es "/Bonafide/public/stock", le quitamos "/Bonafide/public"
if (strpos($request_uri, $script_dir) === 0) {
    $request_uri = substr($request_uri, strlen($script_dir));
}

// C. Ahora sí, $request_uri es solo "/stock" o "/"
$uri_parts = explode('/', trim($request_uri, '/'));
$page = array_shift($uri_parts);

// Si quedó vacío, es home
if (empty($page)) {
    $page = 'home';
}

// 3. Sistema de Control de Rutas (El "Router" simple)
// Esto decide qué archivo de vista cargar.
switch ($page) {
    case 'home':
        // Cargar el archivo de vista (Ej: views/home.php)
        $view_file = BASE_PATH . '/views/home.php';
        break;
        
    case 'login':
        $view_file = BASE_PATH . '/views/login.php';
        break;
        
    case 'registro':
        $view_file = BASE_PATH . '/views/register.php';
        break;
        
    case 'stock':
        // Las vistas anidadas (views/stock/stock.php) requieren la ruta completa
        $view_file = BASE_PATH . '/views/stock/stock.php';
        break;
        
    // Añadir más casos (pedido, productos, etc.) aquí...
    
    default:
        // Si no se encuentra la ruta, muestra el Error 404
        header("HTTP/1.0 404 Not Found");
        $view_file = BASE_PATH . '/views/error_404.php';
        break;
}

// 4. Cargar la Vista Seleccionada
if (file_exists($view_file)) {
    require $view_file;
} else {
    // Esto solo ocurriría si el archivo no existe, pero la ruta fue definida
    header("HTTP/1.0 500 Internal Server Error");
    // O cargar una vista de error genérico
    echo "Error interno: La vista no existe.";
}

/*prueba*/