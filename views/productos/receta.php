<head>
    <title>Bonafide | Añadir Receta</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<?php 
$receta = [
    'id' => 1,
    'nombre' => 'Café Doble Expresso Clásico',
    'tipo' => 'Bebida Caliente',
    'sin_tacc' => true,
    'preparacion' => "1. Calentar taza a 75°C. 2. Moler 18 gramos de Café Bonafide Tostado. 3. Usar máquina Expresso para extraer 30 ml de café en 25 segundos. 4. Decorar con espuma de leche si es capuccino.",
    'ingredientes' => [
        ['nombre' => 'Café Bonafide Tostado', 'cantidad' => 18, 'unidad' => 'gr', 'es_tacc' => true],
        ['nombre' => 'Agua Filtrada', 'cantidad' => 30, 'unidad' => 'ml', 'es_tacc' => true],
        ['nombre' => 'Azúcar (Opcional)', 'cantidad' => 5, 'unidad' => 'gr', 'es_tacc' => true],
        ['nombre' => 'Jugo Natural Naranja (Sin TACC)', 'cantidad' => 200, 'unidad' => 'ml', 'es_tacc' => false],
    ],
];
?>

<style>
    .fixed-width-container { max-width: 1320px !important; }
    
    .ficha-tecnica-card {
        border-left: 5px solid #e53935;
    }
    .ficha-seccion-header {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        font-weight: bold;
        color: #e53935;
        margin-bottom: 15px;
    }
    .sin-tacc-badge {
        background-color: #fd7e14; 
        color: white;
        font-weight: bold;
    }
    .ingrediente-sintacc {
        color: #fd7e14; 
        font-weight: 600;
    }
</style>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h1 class="fw-bold m-0"><?= htmlspecialchars($receta['nombre']) ?></h1>
            
            <a href="<?= BASE_URL ?>/productos" class="btn btn-outline-secondary action-btn">
                <i class="bi bi-arrow-left me-1"></i> Volver al Catálogo
            </a>
        </div>

        <div class="row g-4">
            
            <div class="col-md-5">
                <div class="card p-4 shadow-sm ficha-tecnica-card h-100">
                    <h4 class="mb-3">Información Esencial</h4>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tipo:</span>
                            <span class="fw-bold"><?= htmlspecialchars($receta['tipo']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>ID de Ficha:</span>
                            <span class="fw-bold">REC-<?= $receta['id'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Etiqueta:</span>
                            <?php if ($receta['sin_tacc']): ?>
                                <span class="badge sin-tacc-badge">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Sin TACC
                                </span>
                            <?php else: ?>
                                <span>Estándar</span>
                            <?php endif; ?>
                        </li>
                    </ul>

                    <div class="ficha-seccion-header">Ingredientes Necesarios</div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($receta['ingredientes'] as $ingrediente): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="<?= $ingrediente['es_tacc'] ? '' : 'ingrediente-sintacc' ?>">
                                    <?php if (!$ingrediente['es_tacc']): ?>
                                        <i class="bi bi-asterisk small me-1"></i> 
                                    <?php endif; ?>
                                    <?= htmlspecialchars($ingrediente['nombre']) ?>
                                </span>
                                <span class="fw-bold text-dark">
                                    <?= $ingrediente['cantidad'] ?> <?= htmlspecialchars($ingrediente['unidad']) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="card p-4 shadow-sm h-100">
                    <h4 class="mb-3">Pasos de Preparación (Flujo de Cocina)</h4>
                    
                    <ol class="list-group list-group-numbered">
                        <?php 
                        // Dividir los pasos por el separador ". " o ". " 
                        $pasos = explode('. ', htmlspecialchars($receta['preparacion']));
                        // El array_filter limpia posibles elementos vacíos
                        $pasos = array_filter($pasos); 
                        
                        foreach ($pasos as $paso): ?>
                            <li class="list-group-item">
                                <?= trim($paso, " \t\n\r\0\x0B.") ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                    
                    <h5 class="mt-5 mb-3 text-muted">Tiempo Estimado: 4 minutos</h5>
                </div>
            </div>

        </div>
        
    </div>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>