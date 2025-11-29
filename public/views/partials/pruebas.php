<?php 
// 1. Esto incluye todo: <!DOCTYPE html>, <head>, favicon, CSS, y abre el <body>
include __DIR__ . '/partials/head.php'; 
?>

<?php 
// 2. Esto incluye el código de la barra de navegación (<nav>)
include __DIR__ . '/partials/header.php'; 
?>

<main>
    <div class="container my-5">
        <h2>Página de Pruebas</h2>
        <p>Este es el contenido de la página de pruebas.</p>
    </div>
</main>

<?php 
// 4. Esto incluye el Footer, el JS de Bootstrap, y cierra </body> y </html>
include __DIR__ . '/partials/footer.php'; 
?>