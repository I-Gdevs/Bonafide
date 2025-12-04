<head>
    <title>Bonafide | Proveedores</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

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
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/item-models" class="text-decoration-none text-dark">Modelos de Artículos</a>
                    </li>
                    <li class="list-group-item active">
                        <a href="<?= BASE_URL ?>/stock/providers" class="text-decoration-none text-white fs-5 fw-bold">Proveedores</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/buildings" class="text-decoration-none text-dark">Locales</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-danger me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/><path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/></svg>
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
                                <th>Proveedor</th>
                                <th>CUIT</th>
                                <th>Detalle</th>
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
                                    <tr>
                                        <td><?= $item['nombre_proveedor']?></td>
                                        <td><?= $item['cuit_proveedor']?></td>
                                        <td><?= $item['detalle_proveedor']?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarProveedor"
                                                data-id="<?= $item['id_proveedor'] ?>"
                                                data-nombre="<?= $item['nombre_proveedor'] ?>"
                                                data-cuit="<?= $item['cuit_proveedor'] ?>"
                                                data-detalle="<?= $item['detalle_proveedor'] ?>"
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
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>