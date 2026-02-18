<?php 
    $es_admin = true;
?>

<head>
    <title>Bonafide | Productos</title>
</head>

<?php
    include BASE_PATH . '/views/partials/head.php'; 
    include BASE_PATH . '/views/partials/header.php'; 
?>

<?php
    $categorias = array_filter(array_unique(array_column($products, "categoria_producto")));

    // $productos_raw = [
    //     [
    //         'id' => 101, 'nombre' => 'Café con Leche Clásico', 'descripcion' => 'Receta base de café con leche.',
    //         'precio' => 2800, 
    //         'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg',
    //         'categoria' => 'clasicos', 'es_combo' => false,
    //         'ingredientes' => ['Expresso (50ml)', 'Leche Texturizada (150ml)', 'Azúcar (1 cucharadita)'],
    //         'pasos' => ['1. Preparar el Expresso.', '2. Texturizar la leche a 65°C.', '3. Verter la leche sobre el Expresso.'],
    //         'etiquetas' => ['Sin TACC', 'Vegan Friendly'],
    //     ],
    //     [
    //         'id' => 105, 'nombre' => 'Torta Cheesecake New York', 'descripcion' => 'Postre cremoso con base de galleta.',
    //         'precio' => 5500, 
    //         'imagen' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg',
    //         'categoria' => 'postres', 'es_combo' => false,
    //         'ingredientes' => ['Queso Crema (200g)', 'Galletas Graham (150g)', 'Mantequilla (50g)', 'Vainilla'],
    //         'pasos' => ['1. Triturar galletas y mezclar con mantequilla (base).', '2. Mezclar queso crema, azúcar y vainilla.', '3. Hornear a 160°C por 45 minutos.'],
    //         'etiquetas' => ['Gluten'],
    //     ],
    //     [
    //         'id' => 103, 'nombre' => 'COMBO Tostado con Café', 'descripcion' => 'Café + Tostado jamón y queso',
    //         'precio' => 4800, 
    //         'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg',
    //         'categoria' => 'mediodias', 'es_combo' => true,
    //         'ingredientes' => ['1 Tostado J/Q', '1 Expresso Doble'],
    //         'pasos' => ['1. Tostar el pan con jamón y queso.', '2. Preparar el café.', '3. Servir inmediatamente.'],
    //         'etiquetas' => ['Gluten', 'Combo'],
    //     ],
    //     [
    //         'id' => 106, 'nombre' => 'Latte Vainilla Helado', 'descripcion' => 'Bebida fría y refrescante con toque de vainilla.',
    //         'precio' => 4200, 
    //         'imagen' => 'https://i.pinimg.com/1200x/4e/f0/31/4ef031186eb0275a4f9635b7553031f2.jpg',
    //         'categoria' => 'bebidas_frias', 'es_combo' => false,
    //         'ingredientes' => ['100ml Leche Fría', '50ml Expresso', 'Jarabe de Vainilla', 'Hielo'],
    //         'pasos' => ['1. Llenar el vaso con hielo.', '2. Verter leche y jarabe.', '3. Añadir el Expresso.', '4. Mezclar suavemente.'],
    //         'etiquetas' => ['Frío'],
    //     ],
    //     [
    //         'id' => 108, 'nombre' => 'Muffin de Arándanos', 'descripcion' => 'Muffin esponjoso con arándanos frescos.',
    //         'precio' => 3200, 
    //         'imagen' => 'https://i.pinimg.com/736x/d3/8d/ec/d38decbae9815ad2855408752ff01b0c.jpg',
    //         'categoria' => 'postres', 'es_combo' => false,
    //         'ingredientes' => ['Harina', 'Huevo', 'Azúcar', 'Arándanos'],
    //         'pasos' => ['1. Preparar la mezcla.', '2. Rellenar moldes.', '3. Hornear a 180°C.'],
    //         'etiquetas' => ['Gluten'],
    //     ],
    //     [
    //         'id' => 109, 'nombre' => 'Café Americano', 'descripcion' => 'Café expresso diluido con agua caliente.',
    //         'precio' => 2000, 
    //         'imagen' => 'https://i.pinimg.com/1200x/c3/2c/ff/c32cff96adfec244037e741ad9bd1c6e.jpg',
    //         'categoria' => 'cafeteria', 'es_combo' => false,
    //         'ingredientes' => ['1 Expresso', 'Agua Caliente'],
    //         'pasos' => ['1. Servir el agua caliente.', '2. Agregar el expresso.'],
    //         'etiquetas' => ['Sin Lácteos', 'Sin TACC'],
    //     ],
    //     [
    //         'id' => 110, 'nombre' => 'Sándwich de Palta y Huevo', 'descripcion' => 'Tostada con palta y huevo escalfado.',
    //         'precio' => 4500, 
    //         'imagen' => 'https://i.pinimg.com/736x/53/ce/49/53ce49c785343c391ea36eb8c76e2864.jpg',
    //         'categoria' => 'sandwiches', 'es_combo' => false,
    //         'ingredientes' => ['Pan de masa madre', 'Palta', '1 Huevo', 'Sal y Pimienta'],
    //         'pasos' => ['1. Tostar el pan.', '2. Untar palta.', '3. Escalfar el huevo y colocar encima.'],
    //         'etiquetas' => ['Vegetariano'],
    //     ],
    //     [
    //         'id' => 111, 'nombre' => 'Chocolate Caliente Clásico', 'descripcion' => 'El clásico con un toque de canela.',
    //         'precio' => 3800, 
    //         'imagen' => 'https://i.pinimg.com/1200x/f2/6d/ce/f26dcee0b1546fbbe86c290889751226.jpg',
    //         'categoria' => 'bebidas_calientes', 'es_combo' => false,
    //         'ingredientes' => ['200ml Leche', '30g Chocolate semiamargo', 'Pizca de Canela'],
    //         'pasos' => ['1. Calentar leche.', '2. Derretir el chocolate.', '3. Mezclar con la canela.'],
    //         'etiquetas' => ['Lácteo', 'Invierno'],
    //     ],
    // ];

    // $productos = array_map(function($p) {
    //     if (empty($p['fondo'])) {
    //         $p['fondo'] = $p['imagen'];
    //     }
    //     return $p;
    // }, $productos_raw);

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

        <!-- <section id="receta-display" class="p-4 shadow-lg <?= $receta_activa_class ?>">
            
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
        </section> -->
        
        <div class="row g-4">

            <div class="col-md-2">
                <h4 class="fw-bold my-3">CATEGORIAS</h4>
                
                <ul class="list-group" id="category-list">
                    <li class="list-group-item active" data-category="todos" onclick="filterProducts('todos', this)">
                        <a href="#" class="text-decoration-none">Todos</a>
                    </li>
                    
                    <?php foreach ($categorias as $key => $name): ?>
                    <li class="list-group-item" data-category="<?= $key ?>" onclick="filterProducts('<?= $key ?>', this)">
                        <a href="#" class="text-decoration-none"><?= $name ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-danger w-100 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCrearProducto">
                        <i class="bi bi-plus-lg me-2"></i> Crear producto
                    </button>
                </div>

                <!-- <?php if ($es_admin): ?>
                    <div class="mt-4 pt-3 border-top">
                        <button type="button" class="btn btn-danger w-100 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-plus-lg me-2"></i> Añadir Receta
                        </button>
                    </div>
                <?php endif; ?> -->
            </div>
            
            <div class="col-md-10">

                <div class="row row-cols-1 row-cols-md-4 mt-2 g-3" id="product-grid">
                    <?php foreach ($products as $producto):
                        $filter_categories = $producto['categoria_producto'] . ($producto['es_combo_bool'] ? ' combos' : '');
                        $card_active = ($producto['id_producto'] === $producto_id) ? 'border-danger border-3 shadow-lg' : '';
                    ?>
                    <div class="col product-item" data-categories="<?= $filter_categories ?>">
                        <div class="card h-100 product-card <?= $card_active ?>">
                            <img src="/img/productos/<?= $producto['imagen_url'] ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h6 class="card-title fw-bold"><?= $producto['nombre_producto'] ?></h6>
                                    
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-span">$<?= $producto["precio_producto"] ?></span>
                                    <button class="btn btn-sm btn-outline-danger btn-edit ms-2"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal" 
                                        data-id="<?= $producto['id_producto'] ?>"
                                        data-name="<?= $producto['nombre_producto'] ?>"
                                        onclick="prepareModal(this, <?= json_encode($producto) ?>)"
                                        title="Editar Receta"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

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

<!-- Modal para crear productos -->
<div class="modal fade" id="modalCrearProducto" tabindex="-1" aria-labelledby="labelCrearProducto" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header bg-danger text-white">
                <i class="bi bi-cup-hot me-2 fw-bold fs-4"></i>
                <h5 class="modal-title fw-bold" id="labelCrearProducto">Crear nuevo producto</h5>
                <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= BASE_URL ?>/products/create" method="POST" enctype="multipart/form-data">
                
                <div class="modal-body bg-light">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Nombre del producto</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Chocoffee (leche con chocolate...)" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Categoría</label>
                            <select name="categoria" id="categoria" class="form-select">
                                <option disabled selected value="">Elija una categoría...</option>
                                <option value="Bebida">Bebida</option>
                                <option value="Cafeteria">Cafetería</option>
                                <option value="Pasteleria">Pastelería</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="precio" class="form-control" placeholder="4500" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Imagen del Producto</label>
                        <input type="file" name="imagen" class="form-control" accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <hr class="text-muted">

                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark">Ingredientes / Productos base</label>
                        <div class="input-group mb-3">
                            <select name="items" id="select_insumo" class="form-select">
                                <option disabled selected value="">Elija un item del stock...</option>
                                <?php foreach ($itemTemplates as $item): ?>
                                    <option value="<?= $item["id_modelo_articulo"] ?>" data-unit="<?= $item["unidad_medida_modelo_articulo"] ?>">
                                        <?= $item["nombre_modelo_articulo"] ?> (<?= $item["unidad_medida_modelo_articulo"]?>)
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                
                            <input type="number" id="input_cantidad" class="form-control" placeholder="Cantidad" style="max-width: 120px;">
                            
                            <button class="btn btn-danger" type="button" id="btn_agregar_insumo">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>

                    <div id="lista_ingredientes" class="mb-3 ps-2">
                        <div class="text-muted small fst-italic text-center py-2" id="mensaje_lista_vacia">
                            No hay ingredientes agregados
                        </div>
                    </div>

                    <input type="hidden" name="ingredientes_json" id="ingredientes_json" value="[]">

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Descripción del producto</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light border-0 justify-content-center gap-2 pb-4">
                    <button type="button" class="btn btn-secondary px-4 fw-bold" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle-fill me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger px-4 fw-bold">
                        <i class="bi bi-arrow-right-circle-fill me-2"></i>Crear producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Funciones para el modal de crear productos -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectInsumo = document.getElementById('select_insumo');
        const inputCantidad = document.getElementById('input_cantidad');
        const btnAgregar = document.getElementById('btn_agregar_insumo');
        const contenedorLista = document.getElementById('lista_ingredientes');
        const inputHidden = document.getElementById('ingredientes_json');
        const mensajeVacio = document.getElementById('mensaje_lista_vacia');
        
        let receta = [];

        btnAgregar.addEventListener('click', function() {
            const idInsumo = selectInsumo.value;
            const cantidad = parseFloat(inputCantidad.value);
            
            if (!idInsumo) {
                alert("Por favor, seleccioná un insumo.");
                return;
            }
            if (isNaN(cantidad) || cantidad <= 0) {
                alert("Por favor, ingresá una cantidad válida.");
                return;
            }
            
            const opcionSeleccionada = selectInsumo.options[selectInsumo.selectedIndex];
            const nombreInsumo = opcionSeleccionada.text.trim();
            const unidad = opcionSeleccionada.getAttribute('data-unit') || 'u';

            const nuevoItem = {
                id: idInsumo,
                nombre: nombreInsumo,
                cantidad: cantidad,
                unidad: unidad
            };

            receta.push(nuevoItem);
            actualizarVista();
            
            selectInsumo.value = "";
            inputCantidad.value = "";
            selectInsumo.focus();
        });

        function actualizarVista() {
            inputHidden.value = JSON.stringify(receta);
            contenedorLista.innerHTML = '';
            
            if (receta.length === 0) {
                contenedorLista.appendChild(mensajeVacio);
                mensajeVacio.style.display = 'block';
                return;
            }
            
            receta.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'd-flex justify-content-between align-items-center mb-2 border-bottom pb-1';
                div.innerHTML = `
                    <div class="small fw-bold text-dark">
                        - ${item.cantidad} ${item.unidad}. <span class="fw-normal text-muted ms-2">${item.nombre}</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm text-danger btn-eliminar" data-index="${index}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                `;
                contenedorLista.appendChild(div);
            });

            document.querySelectorAll('.btn-eliminar').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    eliminarItem(index);
                });
            });
        }

        function eliminarItem(index) {
            receta.splice(index, 1);
            actualizarVista();
        }

    })
</script>

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


<!-- Modal para crear recetas -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-plus me-2"></i>Nueva Receta</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="new-recipe-form">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h6 class="text-danger fw-bold mb-3">Imagen de Portada</h6>
                    
                    <div class="border rounded bg-light d-flex align-items-center justify-content-center mb-3 position-relative" 
                         style="height: 250px; overflow: hidden; background-image: url('https://www.bonafide.com.ar/images/logo.png'); background-size: contain; background-repeat: no-repeat; background-position: center; opacity: 0.8;">
                        
                        <img id="preview-new-img" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        
                        <div id="placeholder-text" class="text-muted position-absolute w-100" style="pointer-events: none;">
                            <small>Sin imagen seleccionada</small>
                        </div>
                    </div>

                    <input type="file" id="new-image-file" class="d-none" accept="image/*" onchange="previewImage(this)">
                    
                    <button type="button" class="btn btn-outline-danger w-100" onclick="document.getElementById('new-image-file').click()">
                        <i class="bi bi-upload me-2"></i> Subir Imagen
                    </button>
                    <small class="text-muted d-block mt-2">Formatos: JPG, PNG, WEBP</small>
                </div>
                
                <div class="col-md-8">
                    <h6 class="text-danger fw-bold mb-3">Detalles de la Preparación</h6>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Nombre del Producto</label>
                            <input type="text" class="form-control" placeholder="Ej: Frapuccino Especial">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Categoría</label>
                            <select class="form-select">
                                <?php foreach($categorias as $cat => $name): ?>
                                    <option value="<?= $cat ?>"><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label small fw-bold">Descripción Corta</label>
                            <textarea class="form-control" rows="2" placeholder="Breve descripción para la tarjeta..."></textarea>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="form-label small fw-bold">Ingredientes</label>
                            <div class="input-group mb-2">
                                <input type="text" id="new-ing-name" class="form-control" placeholder="Ingrediente">
                                <input type="text" id="new-ing-qty" class="form-control" placeholder="Cant." style="max-width: 100px;">
                                <button type="button" class="btn btn-success" onclick="addNewIngredient()">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                            <ul id="new-ingredients-list" class="list-group list-group-flush border rounded" style="min-height: 100px; max-height: 150px; overflow-y: auto; background: #f9f9f9;">
                                <li class="list-group-item text-center text-muted small py-4">Agrega ingredientes arriba</li>
                            </ul>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold">Pasos de Preparación</label>
                            <textarea class="form-control" rows="4" placeholder="1. Calentar la leche..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger fw-bold" onclick="saveNewRecipe()">Crear Receta</button>
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

    // --- LÓGICA PARA NUEVA RECETA ---
    
    let newRecipeIngredients = [];

    // 1. Previsualizar Imagen al Subir
    function previewImage(input) {
        const preview = document.getElementById('preview-new-img');
        const placeholder = document.getElementById('placeholder-text');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 2. Gestionar Ingredientes (Modal Nuevo)
    function addNewIngredient() {
        const nameInput = document.getElementById('new-ing-name');
        const qtyInput = document.getElementById('new-ing-qty');
        
        const name = nameInput.value.trim();
        const qty = qtyInput.value.trim();
        
        if(name === '') return;
        
        const itemText = qty ? `${name} (${qty})` : name;
        newRecipeIngredients.push(itemText);
        
        renderNewIngredients();
        
        nameInput.value = '';
        qtyInput.value = '';
        nameInput.focus();
    }

    function removeNewIngredient(index) {
        newRecipeIngredients.splice(index, 1);
        renderNewIngredients();
    }

    function renderNewIngredients() {
        const list = document.getElementById('new-ingredients-list');
        list.innerHTML = '';
        
        if(newRecipeIngredients.length === 0) {
            list.innerHTML = '<li class="list-group-item text-center text-muted small py-4">Agrega ingredientes arriba</li>';
            return;
        }
        
        newRecipeIngredients.forEach((ing, index) => {
            list.innerHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-center py-1">
                    <span><i class="bi bi-dot"></i> ${ing}</span>
                    <button type="button" class="btn btn-sm text-danger p-0" onclick="removeNewIngredient(${index})">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </li>
            `;
        });
    }

    // 3. Guardar Nueva Receta
    function saveNewRecipe() {
        // Aquí iría la lógica para enviar el FormData con la imagen a PHP
        // const formData = new FormData(document.getElementById('new-recipe-form'));
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
        modal.hide();
        
        showNotification('Nueva receta creada correctamente (Simulado)');
        
        // Limpiar formulario para la próxima
        document.getElementById('new-recipe-form').reset();
        newRecipeIngredients = [];
        renderNewIngredients();
        document.getElementById('preview-new-img').style.display = 'none';
        document.getElementById('placeholder-text').style.display = 'block';
    }
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>