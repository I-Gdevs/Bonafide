<?php 
$es_admin = true; 
?>

<head>
    <title>Bonafide | Recetas</title>
</head>

<?php 
if (!defined('BASE_PATH')) define('BASE_PATH', dirname(__DIR__, 2)); 
if (!defined('BASE_URL')) define('BASE_URL', '/');

include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 
?>

<?php
$categorias = [
    'combos' => 'Combos', 
    'clasicos' => 'Clásicos', 
    'bebidas_calientes' => 'Bebidas Calientes', 
    'cafeteria' => 'Cafetería', 
    'bebidas_frias' => 'Bebidas Frías', 
    'postres' => 'Postres',
    'mediodias' => 'Mediodías', 
    'sandwiches' => 'Sandwiches',
];

$etiquetas_disponibles = ['Sin TACC', 'Gluten', 'Vegan Friendly', 'Frío', 'Lácteo', 'Invierno', 'Vegetariano', 'Combo', 'Picante', 'Dietético'];
$etiquetas_disponibles_json = json_encode($etiquetas_disponibles);

$productos_raw = [
    [
        'id' => 101, 'nombre' => 'Café con Leche Clásico', 'descripcion' => 'Receta base de café con leche.',
        'precio' => 2800, 
        'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg',
        'categoria' => 'clasicos', 'es_combo' => false,
        'ingredientes' => ['Expresso (50ml)', 'Leche Texturizada (150ml)', 'Azúcar (1 cucharadita)'],
        'pasos' => ['1. Preparar el Expresso.', '2. Texturizar la leche a 65°C.', '3. Verter la leche sobre el Expresso.'],
        'etiquetas' => ['Sin TACC', 'Vegan Friendly'],
    ],
    [
        'id' => 105, 'nombre' => 'Torta Cheesecake New York', 'descripcion' => 'Postre cremoso con base de galleta.',
        'precio' => 5500, 
        'imagen' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg',
        'categoria' => 'postres', 'es_combo' => false,
        'ingredientes' => ['Queso Crema (200g)', 'Galletas Graham (150g)', 'Mantequilla (50g)', 'Vainilla'],
        'pasos' => ['1. Triturar galletas y mezclar con mantequilla (base).', '2. Mezclar queso crema, azúcar y vainilla.', '3. Hornear a 160°C por 45 minutos.'],
        'etiquetas' => ['Gluten'],
    ],
    [
        'id' => 103, 'nombre' => 'COMBO Tostado con Café', 'descripcion' => 'Café + Tostado jamón y queso',
        'precio' => 4800, 
        'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg',
        'categoria' => 'mediodias', 'es_combo' => true,
        'ingredientes' => ['1 Tostado J/Q', '1 Expresso Doble'],
        'pasos' => ['1. Tostar el pan con jamón y queso.', '2. Preparar el café.', '3. Servir inmediatamente.'],
        'etiquetas' => ['Gluten', 'Combo'],
    ],
    [
        'id' => 106, 'nombre' => 'Latte Vainilla Helado', 'descripcion' => 'Bebida fría y refrescante con toque de vainilla.',
        'precio' => 4200, 
        'imagen' => 'https://i.pinimg.com/1200x/4e/f0/31/4ef031186eb0275a4f9635b7553031f2.jpg',
        'categoria' => 'bebidas_frias', 'es_combo' => false,
        'ingredientes' => ['100ml Leche Fría', '50ml Expresso', 'Jarabe de Vainilla', 'Hielo'],
        'pasos' => ['1. Llenar el vaso con hielo.', '2. Verter leche y jarabe.', '3. Añadir el Expresso.', '4. Mezclar suavemente.'],
        'etiquetas' => ['Frío'],
    ],
    [
        'id' => 108, 'nombre' => 'Muffin de Arándanos', 'descripcion' => 'Muffin esponjoso con arándanos frescos.',
        'precio' => 3200, 
        'imagen' => 'https://i.pinimg.com/736x/d3/8d/ec/d38decbae9815ad2855408752ff01b0c.jpg',
        'categoria' => 'postres', 'es_combo' => false,
        'ingredientes' => ['Harina', 'Huevo', 'Azúcar', 'Arándanos'],
        'pasos' => ['1. Preparar la mezcla.', '2. Rellenar moldes.', '3. Hornear a 180°C.'],
        'etiquetas' => ['Gluten'],
    ],
    [
        'id' => 109, 'nombre' => 'Café Americano', 'descripcion' => 'Café expresso diluido con agua caliente.',
        'precio' => 2000, 
        'imagen' => 'https://i.pinimg.com/1200x/c3/2c/ff/c32cff96adfec244037e741ad9bd1c6e.jpg',
        'categoria' => 'cafeteria', 'es_combo' => false,
        'ingredientes' => ['1 Expresso', 'Agua Caliente'],
        'pasos' => ['1. Servir el agua caliente.', '2. Agregar el expresso.'],
        'etiquetas' => ['Sin Lácteos', 'Sin TACC'],
    ],
    [
        'id' => 110, 'nombre' => 'Sándwich de Palta y Huevo', 'descripcion' => 'Tostada con palta y huevo escalfado.',
        'precio' => 4500, 
        'imagen' => 'https://i.pinimg.com/736x/53/ce/49/53ce49c785343c391ea36eb8c76e2864.jpg',
        'categoria' => 'sandwiches', 'es_combo' => false,
        'ingredientes' => ['Pan de masa madre', 'Palta', '1 Huevo', 'Sal y Pimienta'],
        'pasos' => ['1. Tostar el pan.', '2. Untar palta.', '3. Escalfar el huevo y colocar encima.'],
        'etiquetas' => ['Vegetariano'],
    ],
    [
        'id' => 111, 'nombre' => 'Chocolate Caliente Clásico', 'descripcion' => 'El clásico con un toque de canela.',
        'precio' => 3800, 
        'imagen' => 'https://i.pinimg.com/1200x/f2/6d/ce/f26dcee0b1546fbbe86c290889751226.jpg',
        'categoria' => 'bebidas_calientes', 'es_combo' => false,
        'ingredientes' => ['200ml Leche', '30g Chocolate semiamargo', 'Pizca de Canela'],
        'pasos' => ['1. Calentar leche.', '2. Derretir el chocolate.', '3. Mezclar con la canela.'],
        'etiquetas' => ['Lácteo', 'Invierno'],
    ],
];

$productos = array_map(function($p) {
    if (empty($p['fondo'])) {
        $p['fondo'] = $p['imagen'];
    }
    return $p;
}, $productos_raw);

$receta_seleccionada = null;
$producto_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($producto_id) {
    foreach ($productos as $producto) {
        if ($producto['id'] === $producto_id) {
            $receta_seleccionada = $producto;
            break;
        }
    }
}

if (!$receta_seleccionada && !empty($productos)) {
    $receta_seleccionada = $productos[0];
    $producto_id = $productos[0]['id'];
}
$receta_activa_class = ($receta_seleccionada) ? 'active' : '';
?>

<style>
    /* ESTILOS GENERALES Y MODALES */
    #receta-display {
        min-height: 400px; 
        margin-bottom: 60px; 
        position: relative; 
        overflow: hidden;
        background: #eee;
        border-radius: 12px;
        opacity: 0; 
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }
    
    #receta-display.active {
        opacity: 1;
        box-shadow: 0 0 20px rgba(229, 57, 53, 0.4), 0 0 40px rgba(255, 192, 0, 0.3);
    }

    #receta-bg {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover; background-position: center;
        opacity: 0.1; transition: opacity 0.8s ease-in-out;
    }
    
    .recipe-tag { font-size: 0.85rem; }
    .btn-edit { font-size: 1.2rem; padding: 0.2rem 0.5rem; }

    #modal-receta-img {
        width: 100%; height: 200px; object-fit: cover;
        border-radius: 6px; margin-bottom: 15px;
    }
    
    .fixed-top-right {
        position: fixed; top: 20px; right: 20px;
        z-index: 1050; min-width: 300px;
    }

    #category-list .list-group-item,
    #category-list .list-group-item a {
        font-size: 16px !important;       
        font-weight: normal !important;
        text-decoration: none !important;
        transition: background-color 0.2s ease, color 0.2s ease !important;
        transform: none !important;      
    }

    #category-list .list-group-item.active {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    #category-list .list-group-item.active a {
        color: white !important; 
    }
    
    #category-list .list-group-item:not(.active) a {
        color: #212529 !important; 
    }
    
    #category-list .list-group-item:hover:not(.active) {
        background-color: #f8f9fa;
    }
</style>

<main>
    <div class="container my-2">
        
        <section id="receta-display" class="p-4 shadow-lg <?= $receta_activa_class ?>">
            
            <div id="receta-bg" style="background-image: url('<?= htmlspecialchars($receta_seleccionada['fondo'] ?? '') ?>');"></div>
            
            <div id="receta-content" style="position: relative; z-index: 1;">
                
                <?php if ($receta_seleccionada): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 id="receta-titulo" class="fw-bold text-dark mb-0"><?= htmlspecialchars($receta_seleccionada['nombre']) ?></h2>
                        
                        <?php if ($es_admin): ?>
                            <button class="btn btn-sm btn-outline-danger btn-edit" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal" 
                                    data-id="<?= $receta_seleccionada['id'] ?>"
                                    data-name="<?= htmlspecialchars($receta_seleccionada['nombre']) ?>"
                                    onclick="prepareModal(this, <?= htmlspecialchars(json_encode($receta_seleccionada)) ?>)"
                                    title="Editar Receta">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                    
                    <p id="receta-descripcion" class="text-muted"><?= htmlspecialchars($receta_seleccionada['descripcion']) ?></p>

                    <div class="mt-4 row">
                        <div class="col-md-6">
                            <h5 class="text-danger fw-bold">Ingredientes:</h5>
                            <ul id="receta-ingredientes" class="list-unstyled">
                                <?php foreach ($receta_seleccionada['ingredientes'] as $ing): ?>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i><?= htmlspecialchars($ing) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-danger fw-bold">Pasos:</h5>
                            <ol id="receta-pasos">
                                <?php foreach ($receta_seleccionada['pasos'] as $paso): ?>
                                    <li><?= htmlspecialchars($paso) ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="text-danger fw-bold">Etiquetas:</h5>
                        <span id="receta-etiquetas">
                            <?php foreach ($receta_seleccionada['etiquetas'] as $tag): ?>
                                <span class="badge bg-secondary recipe-tag me-2"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        </span>
                    </div>

                <?php else: ?>
                    <h2 class="fw-bold text-dark">Selecciona un producto</h2>
                    <p class="text-muted">Las recetas aparecerán aquí.</p>
                <?php endif; ?>
            </div>
        </section>
        
        <div class="row g-4">
            
            <div class="col-md-2">
                <h4 class="fw-bold mb-3">CATEGORIAS</h4>
                <ul class="list-group" id="category-list">
                    <li class="list-group-item active" data-category="todos" onclick="filterProducts('todos', this)">
                        <a href="#" class="text-decoration-none">Todos</a>
                    </li>
                    
                    <?php foreach ($categorias as $key => $name): ?>
                    <li class="list-group-item" data-category="<?= $key ?>" onclick="filterProducts('<?= $key ?>', this)">
                        <a href="#" class="text-decoration-none"><?= htmlspecialchars($name) ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="col-md-10">
                <div class="row row-cols-1 row-cols-md-4 g-3" id="product-grid">
                    <?php foreach ($productos as $producto): 
                        $filter_categories = $producto['categoria'] . ($producto['es_combo'] ? ' combos' : '');
                        $card_active = ($producto['id'] === $producto_id) ? 'border-danger border-3 shadow-lg' : '';
                    ?>
                    <div class="col product-item" data-categories="<?= $filter_categories ?>">
                        <div class="card h-100 product-card <?= $card_active ?>">
                            <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="card-title fw-bold"><?= htmlspecialchars($producto['nombre']) ?></h6>
                                    
                                    <?php if ($es_admin): ?>
                                    <button class="btn btn-sm btn-outline-danger btn-edit ms-2"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal" 
                                            data-id="<?= $producto['id'] ?>"
                                            data-name="<?= htmlspecialchars($producto['nombre']) ?>"
                                            onclick="prepareModal(this, <?= htmlspecialchars(json_encode($producto)) ?>)"
                                            title="Editar Receta">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                                <p class="card-text small text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
                                
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="?id=<?= $producto['id'] ?>" class="btn btn-sm btn-danger rounded-pill px-3">Elegir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    </div>
</main>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="editModalLabel">Editar Receta: <span id="receta-name-modal"></span></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="receta-id-modal">
        <form id="receta-edit-form">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="text-danger fw-bold mb-3">URLs e Imagen</h6>
                    <img id="modal-receta-img" src="" alt="Imagen del Producto">
                    <div class="mb-3">
                        <label class="form-label small">URL Imagen (Tarjeta)</label>
                        <input type="text" class="form-control" id="edit-imagen">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">URL Fondo (Receta)</label>
                        <input type="text" class="form-control" id="edit-fondo">
                    </div>
                </div>
                
                <div class="col-md-8">
                    <h6 class="text-danger fw-bold mb-3">Gestión de Ingredientes</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="input-ingrediente" placeholder="Ingrediente">
                        <input type="text" class="form-control" id="input-cantidad" placeholder="Cantidad" maxlength="10">
                        <button class="btn btn-outline-success" type="button" onclick="addIngredient()">
                            <i class="bi bi-plus-circle"></i> Añadir
                        </button>
                    </div>

                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr><th>Ingrediente</th><th>Cantidad</th><th style="width: 10px;">Acción</th></tr>
                        </thead>
                        <tbody id="ingredientes-table-body"></tbody>
                    </table>

                    <div class="mb-3">
                        <label class="form-label small">Pasos (Separados por línea)</label>
                        <textarea class="form-control" id="edit-pasos" rows="4"></textarea>
                    </div>
                </div>
                
                <div class="col-12 mt-4 border-top pt-3">
                    <h6 class="text-danger fw-bold mb-3">Información Principal</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit-nombre">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" id="edit-descripcion" rows="2"></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label d-block">Etiquetas Disponibles:</label>
                            <div id="edit-etiquetas-container" class="border p-2 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="saveChanges()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<script>
    const ETIQUETAS_DISPONIBLES = <?= $etiquetas_disponibles_json ?>;
    let activeIngredients = [];

    function renderIngredientsTable() {
        const tableBody = document.getElementById('ingredientes-table-body');
        tableBody.innerHTML = '';
        if (activeIngredients.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">No hay ingredientes.</td></tr>';
            return;
        }
        activeIngredients.forEach((item, index) => {
            const match = item.match(/^(.*)\s+\((.*)\)$/);
            let ingredient = item;
            let quantity = '-';
            if (match) {
                ingredient = match[1].trim();
                quantity = match[2].trim();
            }
            const row = `
                <tr>
                    <td>${ingredient}</td>
                    <td>${quantity}</td>
                    <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeIngredient(${index})"><i class="bi bi-trash"></i></button></td>
                </tr>`;
            tableBody.innerHTML += row;
        });
    }

    function addIngredient() {
        const inputIng = document.getElementById('input-ingrediente');
        const inputCant = document.getElementById('input-cantidad');
        let newIngredient = inputIng.value.trim();
        let newQuantity = inputCant.value.trim();
        if (newIngredient === '') return;
        let formatted = newIngredient;
        if (newQuantity !== '') formatted = `${newIngredient} (${newQuantity})`;
        activeIngredients.push(formatted);
        renderIngredientsTable();
        inputIng.value = ''; inputCant.value = ''; inputIng.focus();
    }

    function removeIngredient(index) {
        activeIngredients.splice(index, 1);
        renderIngredientsTable();
    }

    function renderTagsCheckboxes(selectedTags = []) {
        const container = document.getElementById('edit-etiquetas-container');
        container.innerHTML = '';
        ETIQUETAS_DISPONIBLES.forEach(tag => {
            const isChecked = selectedTags.includes(tag);
            const tagId = `tag-${tag.replace(/\s/g, '-')}`;
            const html = `
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="${tagId}" value="${tag}" ${isChecked ? 'checked' : ''}>
                    <label class="form-check-label small" for="${tagId}">${tag}</label>
                </div>`;
            container.innerHTML += html;
        });
    }

    function prepareModal(button, receta) {
        activeIngredients = [...receta.ingredientes];
        renderIngredientsTable(); 
        renderTagsCheckboxes(receta.etiquetas); 
        document.getElementById('receta-id-modal').value = receta.id;
        document.getElementById('receta-name-modal').textContent = receta.nombre;
        document.getElementById('modal-receta-img').src = receta.imagen;
        document.getElementById('edit-imagen').value = receta.imagen;
        document.getElementById('edit-fondo').value = receta.fondo || '';
        document.getElementById('edit-nombre').value = receta.nombre;
        document.getElementById('edit-descripcion').value = receta.descripcion;
        document.getElementById('edit-pasos').value = receta.pasos.join('\n');
    }

    function saveChanges() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide(); 
        showNotification('Cambios guardados exitosamente.');
    }

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'alert alert-success alert-dismissible fade show fixed-top-right';
        notification.innerHTML = `<strong>Éxito!</strong> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
        document.body.appendChild(notification);
        setTimeout(() => { if (notification.parentNode) new bootstrap.Alert(notification).close(); }, 4000);
    }

    window.filterProducts = function(categoryKey, clickedElement) {
        const productItems = document.querySelectorAll('.product-item');
        const categoryItems = document.querySelectorAll('#category-list li');
        
        productItems.forEach(item => {
            const itemCategories = item.dataset.categories; 
            item.style.display = (categoryKey === 'todos' || itemCategories.includes(categoryKey)) ? 'block' : 'none';
        });
        
        categoryItems.forEach(item => item.classList.remove('active'));
        if (clickedElement) {
             clickedElement.classList.add('active');
        } else if (categoryKey === 'todos') {
            document.querySelector('#category-list li[data-category="todos"]').classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('receta-display').classList.add('active'); 
        window.filterProducts('todos');
    });
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>