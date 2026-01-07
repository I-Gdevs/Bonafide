<head>
    <title>Bonafide | Proveedores</title>
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
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Modelos de Artículos
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/providers" 
                    class="list-group-item list-group-item-action active fs-5 fw-bold">
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
                        <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalCrearProveedor">
                            <i class="bi bi-plus-lg"></i>
                        </button>

                        <button class="btn btn-outline-secondary ">
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
                                <th>Proveedor</th>
                                <th>CUIT</th>
                                <th>Detalle</th>
                                <th>Acciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaStockBody">
                            <?php if (empty($providerList)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No hay ningún proveedor cargado.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($providerList as $item): ?>
                                    <tr class="align-middle">
                                        <td><?= $item['nombre_proveedor']?></td>
                                        <td><?= $item['cuit_proveedor']?></td>
                                        <td><?= $item['detalle_proveedor']?></td>
                                        <td>
                                            <button class="btn btn-sm btn-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarProveedor"
                                                data-id="<?= $item['id_proveedor'] ?>"
                                                data-nombre="<?= $item['nombre_proveedor'] ?>"
                                                data-cuit="<?= $item['cuit_proveedor'] ?>"
                                                data-detalle="<?= $item['detalle_proveedor'] ?>"
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

<!-- Creación de proveedores -->
<div class="modal fade" id="modalCrearProveedor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Agregar nuevo proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/providers/create">
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nombre/Razón social</label>
                        <input type="text" class="form-control" id="input_nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CUIT/CUIL</label>
                        <input type="text" class="form-control" id="input_cuit" name="cuit" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" rows=3 id="input_detalle" name="detalle" required></textarea>
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

<!-- Edición de proveedores -->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Editar Proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/providers/edit">
                <div class="modal-body">
                    <input type="hidden" id="input_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Nombre/Razón social</label>
                        <input type="text" class="form-control" id="input_nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CUIT/CUIL</label>
                        <input type="text" class="form-control" id="input_cuit" name="cuit" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" rows=3 id="input_detalle" name="detalle" required></textarea>
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
    <div id="toastSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Proveedor</strong>
            <small>Justo ahora</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        
        <div class="toast-body">
            <?= !empty($response['data']['success']) ? $response['data']['success'] : "Y bueno acá está el modal" ?>
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

    // Modal para editar proveedores
    const modalEditar = document.getElementById("modalEditarProveedor");

    modalEditar.addEventListener('show.bs.modal', function (event) {
        const boton = event.relatedTarget;

        const id = boton.getAttribute('data-id');
        const nombre = boton.getAttribute('data-nombre');
        const cuit = boton.getAttribute('data-cuit');
        const detalle = boton.getAttribute('data-detalle');
        
        modalEditar.querySelector('#input_id').value = id;
        modalEditar.querySelector('#input_nombre').value = nombre;
        modalEditar.querySelector('#input_cuit').value = cuit;
        modalEditar.querySelector('#input_detalle').value = detalle;
    });
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>

<?php if (isset($_GET['success'])): ?>
    <script>
        const toastSuccess = document.getElementById('toastSuccess');
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastSuccess);
        toastBootstrap.show();
    </script>
<?php endif; ?>