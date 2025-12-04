<head>
    <title>
        Bonafide
    </title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<style>
    .error-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-height: 60vh; /* Asegura que ocupe una buena parte de la pantalla */
    }
    .error-code {
        font-size: 8rem;
        font-weight: 700;
        color: #dc3545; /* Color rojo de tu marca */
        line-height: 1;
    }
    .error-message {
        font-size: 1.5rem;
        color: #343a40;
        margin-bottom: 1.5rem;
    }
</style>

<main>
    <div class="container">
        <div class="error-container">
                        
            <h1 class="error-code">404</h1>
            
            <h2 class="error-message">Página No Encontrada</h2>
            
            <p class="mb-4">
                Lo sentimos, no pudimos encontrar el recurso solicitado. 
                Parece que has seguido un enlace incorrecto o que la página ha sido eliminada.
            </p>

            <a href="<?= BASE_URL ?>/home" class="btn btn-red btn-lg shadow">
                Ir a la Página Principal
            </a>
            
        </div>
    </div>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>