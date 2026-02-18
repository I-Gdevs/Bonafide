<head>
    <title>Bonafide | Productos</title>
</head>

<?php
    include BASE_PATH . '/views/partials/head.php'; 
    include BASE_PATH . '/views/partials/header.php';
    $flash = getFlash();
?>

<?php
    $categorias = array_filter(array_unique(array_column($products, "categoria_producto")));
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

        <div class="row g-4">

            <div class="col-md-2">
                <div class="my-4 py-3 border-bottom">
                    <button type="button" class="btn btn-danger w-100 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCrearProducto">
                        <i class="bi bi-plus-lg me-2"></i> Crear producto
                    </button>
                </div>
                <h3 class="fw-bold my-3">CATEGORIAS</h3>
                
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
                

            </div>
            
            <div class="col-md-10">

                <div class="row row-cols-1 row-cols-md-4 mt-2 g-3" id="product-grid">
                    <?php foreach ($products as $producto):
                        $filter_categories = $producto['categoria_producto'] . ($producto['es_combo_bool'] ? ' combos' : '');
                        $card_active = ($producto['id_producto'] === $producto_id) ? 'border-danger border-3 shadow-lg' : '';
                        $jsonProducto = htmlspecialchars(json_encode($producto));
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
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-danger ms-2 me-2 btn-editar-producto"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditarProducto" 
                                            data-producto="<?= $jsonProducto ?>"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
    
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEliminarProducto"
                                            data-id="<?= $producto['id_producto'] ?>"
                                            data-nombre="<?= $producto['nombre_producto'] ?>"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>
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

<!-- Modal para editar productos -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Editar Producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= BASE_URL ?>/products/edit" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="id" id="edit_id_producto">
                
                <div class="modal-body bg-light">
                    <div class="mb-3">
                        <label class="fw-bold small">Nombre del producto</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold small">Categoría</label>
                            <select name="categoria" id="edit_categoria" class="form-select">
                                <option value="Bebida">Bebida</option>
                                <option value="Cafeteria">Cafetería</option>
                                <option value="Pasteleria">Pastelería</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="precio" id="edit_precio" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold small">Imagen (Dejar vacío para mantener la actual)</label>
                        <input type="file" name="imagen" class="form-control">
                        <div id="preview_imagen_actual" class="form-text text-primary mt-1"></div>
                    </div>
                    
                    <input type="hidden" name="imagen_actual" id="edit_imagen_actual_hidden">

                    <hr>

                    <div class="mb-2">
                        <label class="fw-bold small">Editar Receta</label>
                        <div class="input-group mb-3">
                            <select id="edit_select_insumo" class="form-select">
                                <option disabled selected value="">Agregar insumo...</option>
                                <?php foreach ($itemTemplates as $item): ?>
                                    <option value="<?= $item["id_modelo_articulo"] ?>" data-unit="<?= $item["unidad_medida_modelo_articulo"]?>">
                                        <?= $item["nombre_modelo_articulo"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="number" id="edit_input_cantidad" class="form-control" placeholder="Cantidad" style="max-width: 120px;">
                            <button class="btn btn-danger" type="button" id="btn_edit_agregar_insumo">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>

                    <div id="edit_lista_ingredientes" class="mb-3 ps-2"></div>
                    
                    <input type="hidden" name="ingredientes_json" id="edit_receta_json">

                    <div class="mb-3">
                        <label class="fw-bold small">Descripción</label>
                        <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger fw-bold">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Funciones para el modal de editar productos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    
    let recetaEdicion = []; 
    const modalEditar = new bootstrap.Modal(document.getElementById('modalEditarProducto'));

    document.querySelectorAll('.btn-editar-producto').forEach(btn => {
        btn.addEventListener('click', function() {
            
            const dataString = this.getAttribute('data-producto');
            const producto = JSON.parse(dataString);

            console.log("Editando producto:", producto);

            document.getElementById('edit_id_producto').value = producto.id_producto;
            document.getElementById('edit_nombre').value = producto.nombre_producto;
            document.getElementById('edit_precio').value = producto.precio_producto;
            document.getElementById('edit_categoria').value = producto.categoria_producto;
            document.getElementById('edit_descripcion').value = producto.descripcion_producto || '';
            document.getElementById('edit_imagen_actual_hidden').value = producto.product_image_url || producto.imagen_url;
            
            document.getElementById('preview_imagen_actual').innerText = 
                `Imagen actual: ${producto.imagen_url}`;

            const ingredientesDesdeApi = producto.ingredientes || [];

            recetaEdicion = ingredientesDesdeApi.map(ing => ({
                id: ing.id_modelo_articulo,
                nombre: ing.nombre,
                cantidad: parseFloat(ing.cantidad),
                unidad: ing.unidad
            }));

            actualizarVistaEdicion();
            modalEditar.show();
        });
    });

    document.getElementById('btn_edit_agregar_insumo').addEventListener('click', function() {
        const select = document.getElementById('edit_select_insumo');
        const inputCant = document.getElementById('edit_input_cantidad');
        
        if (!select.value || !inputCant.value) return;

        const nuevoItem = {
            id: select.value,
            nombre: select.options[select.selectedIndex].text.trim(),
            cantidad: parseFloat(inputCant.value),
            unidad: select.options[select.selectedIndex].getAttribute('data-unit')
        };

        recetaEdicion.push(nuevoItem);
        actualizarVistaEdicion();
        
        select.value = "";
        inputCant.value = "";
    });

    window.eliminarItemEdicion = function(index) {
        recetaEdicion.splice(index, 1);
        actualizarVistaEdicion();
    }

    function actualizarVistaEdicion() {
        const contenedor = document.getElementById('edit_lista_ingredientes');
        const inputHidden = document.getElementById('edit_receta_json');
        
        inputHidden.value = JSON.stringify(recetaEdicion);
        
        contenedor.innerHTML = '';

        if (recetaEdicion.length === 0) {
            contenedor.innerHTML = '<div class="text-muted small fst-italic">Sin ingredientes.</div>';
            return;
        }

        recetaEdicion.forEach((item, index) => {
            contenedor.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-1">
                    <div class="small text-dark">
                        <strong>${item.cantidad} ${item.unidad}</strong> - ${item.nombre}
                    </div>
                    <button type="button" class="btn btn-sm text-danger" onclick="eliminarItemEdicion(${index})">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            `;
        });
    }
});
</script>

<!-- Modal para eliminar productos -->
<div class="modal fade" id="modalEliminarProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="<?= BASE_URL ?>/products/delete" method="POST">
                <div class="modal-body text-center py-4">
                    <i class="bi bi-exclamation-triangle text-warning display-1"></i>
                    <h4 class="mt-3">¿Estás seguro?</h4>
                    <p>Vas a eliminar el producto: <strong id="nombre_producto_eliminar"></strong></p>
                    <p class="text-muted small">Esta acción lo ocultará del sistema de ventas.</p>
                    
                    <input type="hidden" name="id_eliminar" id="input_id">
                </div>

                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger fw-bold">Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Funciones para el modal de eliminar productos -->
<script>
	const modalEliminarProducto = document.getElementById("modalEliminarProducto");

	modalEliminarProducto.addEventListener('show.bs.modal', function (event) {
		const boton = event.relatedTarget;

		const id = boton.getAttribute('data-id');
		
		modalEliminarProducto.querySelector('#input_id').value = id;
	});

</script>

<!-- FLASH - TOAST ALERTA -->
<?php if ($flash): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="flashToast" class="toast bg-<?= $flash["type"] ?>-subtle" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Avisos | Productos</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $flash["message"]; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let toastElement = document.getElementById("flashToast");
            var toastTrigger = new bootstrap.Toast(toastElement);
            toastTrigger.show();
        });
    </script>
<?php endif; ?>


<?php include BASE_PATH . '/views/partials/footer.php'; ?>