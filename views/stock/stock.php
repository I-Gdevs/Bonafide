<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        <div class="row g-4">
            <div class="col-md-3">
                <ul class="list-group list-unstyled-borders">
                    
                    <li class="list-group-item active">
                        <a href="<?= BASE_URL ?>/stock" class="text-decoration-none text-white fs-5 fw-bold">Mi stock</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/movements" class="text-decoration-none text-dark">Movimientos</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="<?= BASE_URL ?>/stock/item-models" class="text-decoration-none text-dark">Modelos de Artículos</a>
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
                <div class="d-flex justify-content-end align-items-center mb-3">
                    
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="buscadorStock" placeholder="Buscar...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Artículo</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Acciones</th> </tr>
                        </thead>
                        <tbody id="tablaStockBody">
                            <?php if (empty($stockList)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No hay artículos cargados.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($stockList as $item): ?>
                                    <tr data-id="<?= $item['id'] ?>" data-nombre="<?= $item['nombre'] ?>" data-unidad="<?= $item['unidad_medida'] ?>">
                                        <td><?= $item['nombre']?></td>
                                        <td class="<?= $item['cantidad'] < 20 ? 'text-danger fw-bold' : '' ?>"><?= $item['cantidad']?></td>
                                        <td><?= $item['unidad_medida']?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger editar-articulo-btn" data-bs-toggle="modal" data-bs-target="#modalEditarArticulo">
                                                <i class="bi bi-pen"></i>
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

<div class="modal fade" id="modalCrearArticulo" tabindex="-1" aria-labelledby="modalCrearArticuloLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalCrearArticuloLabel">Crear Nuevo Artículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="formCrearArticulo" action="[URL_DEL_CONTROLADOR_PARA_CREAR]" method="POST">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="nuevoNombre" class="form-label">Nombre / Descripción</label>
                        <input type="text" class="form-control" id="nuevoNombre" name="nombre" required placeholder="Ej: Café Bonafide bolsa 1kg">
                    </div>
                    
                    <div class="mb-3">
                        <label for="nuevaUnidad" class="form-label">Unidad de Medida</label>

                        <select class="form-select" id="nuevaUnidad" name="unidad" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="kg">Kilogramo (kg)</option>
                            <option value="gr">Gramo (gr)</option>
                            <option value="unid">Unidad (unid)</option>
                            <option value="lt">Litro (lt)</option>
                            <option value="ml">Mililitro (ml)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nuevoStockMinimo" class="form-label">Stock Mínimo de Alerta</label>
                        <input type="number" class="form-control" id="nuevoStockMinimo" name="stock_minimo" min="0" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarArticulo" tabindex="-1" aria-labelledby="modalEditarArticuloLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEditarArticuloLabel">Editar Artículo: <span id="editarNombreArticulo"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="formEditarArticulo" action="[URL_DEL_CONTROLADOR_PARA_EDITAR]" method="POST">
                <input type="hidden" id="editarArticuloId" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre / Descripción</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarUnidad" class="form-label">Unidad de Medida</label>
                        <select class="form-select" id="editarUnidad" name="unidad" required>
                            <option value="kg">Kilogramo (kg)</option>
                            <option value="gr">Gramo (gr)</option>
                            <option value="unid">Unidad (unid)</option>
                            <option value="lt">Litro (lt)</option>
                            <option value="ml">Mililitro (ml)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editarStockMinimo" class="form-label">Stock Mínimo de Alerta</label>
                        <input type="number" class="form-control" id="editarStockMinimo" name="stock_minimo" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

// Modal Edicion
document.addEventListener('DOMContentLoaded', function() {
    const tablaBody = document.getElementById('tablaStockBody');
    const modalEditar = document.getElementById('modalEditarArticulo');
    const editarNombreArticulo = document.getElementById('editarNombreArticulo');
    
    // Obtenemos los campos del formulario de edición
    const inputId = document.getElementById('editarArticuloId');
    const inputNombre = document.getElementById('editarNombre');
    const selectUnidad = document.getElementById('editarUnidad');

    tablaBody.addEventListener('click', function(e) {
        // Verificamos si el clic fue en el botón de edición
        if (e.target.closest('.editar-articulo-btn')) {
            const button = e.target.closest('.editar-articulo-btn');
            const row = button.closest('tr');
            
            // 1. Extraer los datos de la fila (Usando data-* attributes es más seguro que leer celdas)
            const id = row.getAttribute('data-id');
            const nombre = row.getAttribute('data-nombre');
            const unidad = row.getAttribute('data-unidad');
                        
            // 2. Rellenar el título del modal
            editarNombreArticulo.textContent = nombre;
            
            // 3. Rellenar el formulario
            inputId.value = id;
            inputNombre.value = nombre;
            selectUnidad.value = unidad; // Esto selecciona la opción correcta
        }
    });
});
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>