<?php 
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 2)); 
}
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/Bonafide/public'); 
}
?>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<?php
$stockList = [
    ['id' => 1, 'nombre' => 'Café Bonafide bolsa 1kg', 'cantidad' => 150, 'unidad_medida' => 'unid'],
    ['id' => 2, 'nombre' => 'Paquete de azucar 1kg', 'cantidad' => 500, 'unidad_medida' => 'kg'],
    ['id' => 3, 'nombre' => 'Chocolate en barra 200gr', 'cantidad' => 15, 'unidad_medida' => 'unid'],
    ['id' => 4, 'nombre' => 'Coca Cola 500ml', 'cantidad' => 150, 'unidad_medida' => 'ml'],
];
?>

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
                        <a href="#" class="text-decoration-none text-dark">Modelos de Artículos</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Proveedores</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Locales</a>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-white" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.10l-3 1a.5.5 0 0 1-.65-.65l1-3a.5.5 0 0 1 .1-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 2.12a.5.5 0 0 1 .282.284l.793 3.965a.5.5 0 0 1-.137.662l-4.204 4.203a.5.5 0 0 1-.676.046l-3.238-3.567a.5.5 0 0 1 .69-.737l3.238 3.567 4.204-4.203a.5.5 0 0 1 .282-.284z"/>
                                                </svg>
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