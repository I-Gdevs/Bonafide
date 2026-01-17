<head>
    <title>Bonafide | Locales</title>
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
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-truck me-2"></i>
                        Proveedores
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/buildings" 
                    class="list-group-item list-group-item-action active fs-5 fw-bold">
                        <i class="bi bi-shop me-2"></i>
                        Locales
                    </a>
                </div>
            </div>
            
            <div class="col-md-9">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-danger me-2">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-filter-left"></i>
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
                                <th>Local</th>
                                <th>Dirección</th>
                                <th>Empleados</th>
                                <th>Encargado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaStockBody">
                            <?php if (empty($buildingList)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No hay ningún local cargado</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($buildingList as $item): ?>
                                    <tr>
                                        <td><?= $item['nombre']?></td>
                                        <td><?= $item['direccion']?></td>
                                        <td><?= $item['cantidad_empleados']?></td>
                                        <td><?= $item['encargado']?></td>
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