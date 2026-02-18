<head>
    <title>Bonafide | Seleccionar Local</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<?php
$locales = [
    [
        'id' => 1, 
        'nombre' => 'Bonafide Peatonal', 
        'direccion' => 'Mitre 37, Concordia', 
        'horario' => '08:00 a 19:00',
        'imagen' => BASE_URL . '/img/fachadasLocales/Peatonal.png'
    ],
    [
        'id' => 2, 
        'nombre' => 'Bonafide Tribunales', 
        'direccion' => 'Mitre 140, Concordia', 
        'horario' => '07:30 a 20:00',
        'imagen' => BASE_URL . '/img/fachadasLocales/Tribunales.png'
    ]
];
?>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        <h1 class="fw-bold mb-3">Seleccione su Local</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
    
    <?php foreach ($locales as $local): ?>
    <div class="col">
        <a href="<?= BASE_URL ?>/pedir" class="text-decoration-none text-dark">
            <div class="card local-card h-100">
                <img src="<?= htmlspecialchars($local['imagen']) ?>" class="card-img-top" alt="Fachada <?= $local['nombre'] ?>">
                
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($local['nombre']) ?></h5>
                    </div>
                
                <div class="card-footer card-footer-action text-center">
                    Seleccionar Local
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>

</div>
        
    </div>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>