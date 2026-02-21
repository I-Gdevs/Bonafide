<head>
    <title>Bonafide | Seleccionar Local</title>
    <style>
        .local-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #eaeaea;
            cursor: pointer;
        }
        .local-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            border-color: #D92027;
        }
        .local-img-wrapper {
            height: 180px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .local-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<main>
    <div class="container my-5 mx-auto">
        
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Elija su local favorito</h2>
            <p class="text-muted">Seleccioná la sucursal desde donde vas a realizar tu pedido</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
        
        <?php foreach ($buildings as $local): ?>
        <div class="col">
            <a href="<?= BASE_URL ?>/set-local?id=<?= $local['id'] ?>&nombre=<?= urlencode($local['nombre']) ?>" class="text-decoration-none text-dark">
                <div class="card local-card h-100 shadow-sm">
                    
                    <div class="local-img-wrapper border-bottom">
                        <?php $imgSrc = !empty($local['imagen']) ? $local['imagen'] : BASE_URL . '/img/shops/Peatonal.png'; ?>
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="Fachada <?= htmlspecialchars($local['nombre_local'] ?? $local['nombre']) ?>">
                    </div>
                    
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold text-dark mb-1">
                            <?= htmlspecialchars($local['nombre_local'] ?? $local['nombre']) ?>
                        </h5>
                        <p class="text-muted small mb-0">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                            <?= htmlspecialchars($local['direccion'] ?? 'Sucursal Bonafide') ?>
                        </p>
                    </div>
                    
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        
        </div>
    </div>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>