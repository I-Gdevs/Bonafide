<head>
    <title>Bonafide | Modelos de Artículos</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="<?= BASE_URL ?>/stock" 
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-box-seam me-2"></i>
                        Mi stock
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/movements" 
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Movimientos
                    </a>

                    <a href="<?= BASE_URL ?>/stock/item-models" 
                    class="list-group-item list-group-item-action active fs-5 fw-bold">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Modelos de Artículos
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/providers" 
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-truck me-2"></i>
                        Proveedores
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/buildings" 
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-shop me-2"></i>
                        Locales
                    </a>
                </div>
            </div>
            
            <div class="col-md-9">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalCreaerModeloArticulo">
                            <i class="bi bi-plus-lg"></i>
                        </button>

                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="buscadorStock" placeholder="Buscar...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Artículo</th>
                                <th>Unidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaStockBody">
                            <?php if (empty($itemModelsList)): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">No hay ningún modelo de artículo.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($itemModelsList as $item): ?>
                                    <tr>
                                        <td><?= $item['nombre_ingrediente']?></td>
                                        <td><?= $item['unidad_medida_ingrediente']?></td>
                                        <td>
                                            <button class="btn btn-sm btn-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarModeloArticulo"
                                                data-id="<?= $item['id_ing_mod'] ?>"
                                                data-nombre="<?= $item['nombre_ingrediente'] ?>"
                                                data-unidad="<?= $item['unidad_medida_ingrediente'] ?>"
                                            >
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Creación de modelos de artículos -->
 <div class="modal fade" id="modalCreaerModeloArticulo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Crear nuevo Modelo de Artículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/item-models/create">
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nombre de artículo</label>
                        <input type="text" class="form-control" id="input_nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unidad de medida</label>
                        <select class="form-select" id="input_unidad" name="unidad" required>
                            <option selected disabled>Seleccione unidad</option>
                            <option value="g">gramos (g)</option>
                            <option value="kg">kilogramos (kg)</option>
                            <option value="l">litros (l)</option>
                            <option value="ml">mililitros (ml)</option>
                            <option value="u">unidad (u)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edición de modelos de artículos -->
<div class="modal fade" id="modalEditarModeloArticulo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEditarArticuloLabel">Editar Modelo de Artículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/item-models/edit">
                <div class="modal-body">
                    <input type="hidden" name="id" id="input_id">

                    <div class="mb-3">
                        <label class="form-label">Nombre del artículo</label>
                        <input type="text" class="form-control" id="input_nombre" name="nombre" required>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Unidad de Medida</label>
                        <select class="form-select" id="input_unidad" name="unidad" disabled>
                            <option value="g">gramos (g)</option>
                            <option value="kg">kilogramos (kg).</option>
                            <option value="l">litros (l)</option>
                            <option value="ml">mililitros (ml)</option>
                            <option value="u">unidad (u)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TOAST ALERTA -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastAlert" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-<?= (!empty($response['data']['success'])) ? "success" : (!empty($response['data']['error']) ? "danger" : "info")?> text-white">
            <strong class="me-auto">Modelo de artículo</strong>
            <small>Justo ahora</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        
        <div class="toast-body">
            <?= !empty($response['data']['success']) ? $response['data']['success'] : "Procesado correctamente" ?>
        </div>
    </div>
</div>

<script>
    // Buscador
    document.getElementById('buscadorStock').addEventListener('keyup', function() {
        let searchText = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tablaStockBody tr');

        rows.forEach(row => {
            let nombre = row.cells[0].innerText.toLowerCase();
            if (nombre.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Modal para editar modelos de artículos
    const modalEditar = document.getElementById("modalEditarModeloArticulo");

    modalEditar.addEventListener('show.bs.modal', function (event) {
        const boton = event.relatedTarget;

        const id = boton.getAttribute('data-id');
        const nombre = boton.getAttribute('data-nombre');
        const unidad = boton.getAttribute('data-unidad');
        
        modalEditar.querySelector('#input_id').value = id;
        modalEditar.querySelector('#input_nombre').value = nombre;
        modalEditar.querySelector('#input_unidad').value = unidad;
    });

</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>

<?php if (isset($_GET['success'])): ?>
    <script>
        const toastAlert = document.getElementById('toastAlert');
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastAlert);
        toastBootstrap.show();
    </script>
<?php endif; ?>