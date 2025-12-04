<head>
    <title>Bonafide | Modelos de Artículos</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ¡Artículo actualizado correctamente!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error: <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<main>
    <div class="container my-5 fixed-width-container mx-auto">

        <div class="row g-4">
            <div class="col-md-3">
                <ul class="list-group list-unstyled-borders">
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock" class="text-decoration-none text-dark">Mi stock</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/movements" class="text-decoration-none text-dark">Movimientos</a>
                    </li>
                    <li class="list-group-item active">
                        <a href="<?= BASE_URL ?>/stock/item-models" class="text-decoration-none text-white fs-5 fw-bold">Modelos de Artículos</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/providers" class="text-decoration-none text-dark">Proveedores</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/buildings" class="text-decoration-none text-dark">Locales</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-9">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalCrearArticulo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/></svg>
                        </button>

                        <button class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16"><path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/></svg>
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
                                    <td colspan="4" class="text-center py-4 text-muted">No hay ningún modelo de artículo.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($itemModelsList as $item): ?>
                                    <tr>
                                        <td><?= $item['nombre_ingrediente']?></td>
                                        <td><?= $item['unidad_medida_ingrediente']?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarModeloArticulo"
                                                data-id="<?= $item['id_ing_mod'] ?>"
                                                data-nombre="<?= $item['nombre_ingrediente'] ?>"
                                                data-unidad="<?= $item['unidad_medida_ingrediente'] ?>"
                                            >
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
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
                            <option value="gr.">gr.</option>
                            <option value="Kg.">Kg.</option>
                            <option value="lts.">lts.</option>
                            <option value="ml.">ml.</option>
                            <option value="u.">u.</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
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