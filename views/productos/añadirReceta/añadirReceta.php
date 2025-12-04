<head>
    <title>Bonafide | Añadir Receta</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>


<?php
$ingredientes_stock = [
    ['id' => 1, 'nombre' => 'Café Bonafide bolsa', 'unidad' => 'kg'],
    ['id' => 2, 'nombre' => 'Leche Entera', 'unidad' => 'lt'],
    ['id' => 3, 'nombre' => 'Azúcar (Paquetes)', 'unidad' => 'unid'],
    ['id' => 4, 'nombre' => 'Tostado Queso', 'unidad' => 'unid'],
    ['id' => 5, 'nombre' => 'Chocolate en Barra', 'unidad' => 'gr'],
];
?>

<style>
    /* Asegurar ancho fijo de 1320px */
    .fixed-width-container { max-width: 1320px !important; }
    .card-receta { border-left: 4px solid #e53935; }
    .ingrediente-fila { border-bottom: 1px dashed #e9ecef; padding-bottom: 8px; }
    .ingrediente-fila:last-child { border-bottom: none; }
</style>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h1 class="fw-bold mb-4">Armado de Recetas</h1>
            
            
            <a href="<?= BASE_URL ?>/productos" class="btn btn-outline-secondary action-btn">
                <i class="bi bi-arrow-left me-1"></i> Volver al Catálogo
            </a>
        </div>
        <p class="text-muted mb-4">Defina la composición de un nuevo producto usando artículos del inventario (Stock).</p>

        <form id="formArmadoReceta" action="[URL_CONTROLADOR_RECETAS_GUARDAR]" method="POST">
            
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="card p-4 shadow-sm mb-4 card-receta">
                        <h4 class="fw-bold text-danger mb-3">Información General</h4>

                        <div class="mb-3">
                            <label for="nombreReceta" class="form-label">Nombre del Producto/Receta</label>
                            <input type="text" class="form-control" id="nombreReceta" name="nombre_receta" required placeholder="Ej: Café Doble Expresso">
                        </div>
                        
                        <div class="mb-3">
                            <label for="tipoReceta" class="form-label">Tipo de Receta</label>
                            <select class="form-select" id="tipoReceta" name="tipo_receta" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="bebida">Bebida</option>
                                <option value="comida">Comida (Alimentos)</option>
                                <option value="combo">Combo Promocional</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="esSinTacc" class="form-label">Etiquetas Especiales</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="esSinTacc" name="sin_tacc">
                                <label class="form-check-label" for="esSinTacc">
                                    Apto Sin TACC / Apto Celíacos
                                </label>
                            </div>
                        </div>

                        <h4 class="fw-bold text-danger mb-3 mt-4">Pasos de Preparación</h4>
                        <div class="mb-3">
                            <label for="preparacion" class="form-label">Instrucciones Detalladas para el KDS</label>
                            <textarea class="form-control" id="preparacion" name="preparacion" rows="6" required placeholder="1. Calentar leche a 70°C. 2. Añadir jarabe. 3. Servir y decorar."></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-4 shadow-sm mb-4 card-receta">
                        <h4 class="fw-bold text-danger mb-3">Composición de Ingredientes</h4>
                        <p class="text-muted small">Seleccione los artículos de stock y la cantidad exacta necesaria.</p>

                        <div id="listaIngredientes" class="mb-4">
                            </div>

                        <h5 class="fw-bold text-dark mb-3 border-top pt-3">Añadir Ingrediente</h5>
                        
                        <div class="row g-2 mb-3 align-items-end">
                            <div class="col-md-6">
                                <label for="selectArticulo" class="form-label small">Artículo (Stock)</label>
                                <select class="form-select form-select-sm" id="selectArticulo">
                                    <?php foreach ($ingredientes_stock as $item): ?>
                                        <option value="<?= $item['id'] ?>" data-unidad="<?= $item['unidad'] ?>">
                                            <?= htmlspecialchars($item['nombre']) ?> (<?= $item['unidad'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputCantidad" class="form-label small">Cantidad Requerida</label>
                                <input type="number" class="form-control form-control-sm" id="inputCantidad" min="0.01" step="0.01" placeholder="Ej: 0.5">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-sm w-100" id="btnAddIngrediente">
                                    <i class="bi bi-plus-lg"></i> +
                                </button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3 mb-5">
                 <button type="submit" class="btn btn-red btn-lg w-50">
                    <i class="bi bi-save me-2"></i> Guardar Receta
                </button>
            </div>
            
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnAdd = document.getElementById('btnAddIngrediente');
    const selectArticulo = document.getElementById('selectArticulo');
    const inputCantidad = document.getElementById('inputCantidad');
    const listaIngredientes = document.getElementById('listaIngredientes');
    let ingredienteCount = 0;

    btnAdd.addEventListener('click', function() {
        const articuloId = selectArticulo.value;
        const articuloNombre = selectArticulo.options[selectArticulo.selectedIndex].text;
        const unidad = selectArticulo.options[selectArticulo.selectedIndex].dataset.unidad;
        const cantidad = parseFloat(inputCantidad.value);

        if (!articuloId || isNaN(cantidad) || cantidad <= 0) {
            alert("Por favor, selecciona un artículo e ingresa una cantidad válida.");
            return;
        }

        ingredienteCount++;
        const newRow = document.createElement('div');
        newRow.className = 'ingrediente-fila d-flex justify-content-between align-items-center py-2';
        newRow.innerHTML = `
            <div class="d-flex align-items-center">
                <span class="badge bg-secondary me-3">${cantidad} ${unidad}</span>
                <span class="fw-bold">${articuloNombre}</span>
                
                <input type="hidden" name="ingredientes[${ingredienteCount}][id]" value="${articuloId}">
                <input type="hidden" name="ingredientes[${ingredienteCount}][cantidad]" value="${cantidad}">
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-ingrediente">
                <i class="bi bi-trash"></i>
            </button>
        `;
        
        listaIngredientes.appendChild(newRow);

        // Limpiar inputs después de agregar
        inputCantidad.value = '';
        selectArticulo.value = '';
    });

    // Función para eliminar ingrediente dinámicamente
    listaIngredientes.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-ingrediente') || e.target.closest('.btn-remove-ingrediente')) {
            const btn = e.target.closest('.btn-remove-ingrediente');
            btn.closest('.ingrediente-fila').remove();
        }
    });
});
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>