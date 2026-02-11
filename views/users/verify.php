<head>
	<title>Bonafide | Verificar cuenta</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>
    
<main>
    <div class="card-body text-center p-4">
        
        <?php if ($verificado): ?>
            <div class="mb-4 text-success">
                <i class="bi bi-patch-check-fill" style="font-size: 4rem;"></i>
            </div>
            <h4 class="mb-2 fw-bold">¡Cuenta Activada!</h4>
            <p class="text-muted mb-4"><?= $success ?></p>
            
            <a href="/login" class="btn btn-danger w-100 fw-bold">Ir a Iniciar Sesión</a>

        <?php else: ?>
            <div class="mb-4 text-danger">
                <i class="bi bi-x-octagon-fill" style="font-size: 4rem;"></i>
            </div>
            <h4 class="mb-2 fw-bold">Hubo un error</h4>
            <p class="text-muted mb-4"><?= $error ?></p>
            
            <a href="/login" class="btn btn-outline-secondary w-100">Volver al Login</a>
        <?php endif; ?>

    </div>
</main>

<style>
    body { background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; justify-content: center; }
    .card-auth { max-width: 400px; width: 100%; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
    .header-auth { background-color: #D32F2F; padding: 20px; text-align: center; }
    .header-auth h2 { color: white; margin: 0; font-weight: bold; letter-spacing: 1px; }
</style>