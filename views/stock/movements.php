<head>
    <title>Bonafide | Movimientos de Stock</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>
<?php $flash = getFlash(); ?>

<script>
    const DATA_ITEM_TEMPLATES = <?= json_encode($itemTemplates); ?>
</script>

<main>
    <div class="container my-5 fixed-width-container mx-auto d-md-block d-none">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="<?= BASE_URL ?>/stock" 
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-box-seam me-2"></i>
                        Mi stock
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/movements" 
                    class="list-group-item list-group-item-action active fw-bold">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Movimientos
                    </a>

                    <a href="<?= BASE_URL ?>/stock/item-templates" 
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
                    class="list-group-item list-group-item-action text-dark">
                        <i class="bi bi-shop me-2"></i>
                        Locales
                    </a>
                </div>
            </div>
            
            <div class="col-md-9">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalRegistrarCompra">
                            <i class="bi bi-box-seam"></i>
                        </button>
                        
                        <button class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#modalRegistrarAjuste">
                            <i class="bi bi-sliders"></i>
                        </button>

                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalFiltrarMovimientos" title="Filtrar Movimientos">
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
                                <th>Movimiento</th>
                                <th>Fecha</th>
                                <th>Local</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaMovimientosBody">
                            <?php if (empty($movimientos)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No hay ningún movimiento cargado.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($movimientos as $item): ?>
                                    <tr>
                                        <td><?= $item["motivo_movimiento"]?></td>
                                        <td><?= date("d/m/Y H:i", strtotime($item["fecha"])) ?></td>
                                        <td><?= $item["nombre_local"]?></td>
                                        <td><?= $item["usuario"]?></td>
                                        <td class="text-start">
                                            <button class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalVerDetalleMovimiento"
                                                data-movement-reason="<?= $item["motivo_movimiento"] ?>"
                                                data-type="<?= $item["tipo_movimiento"] ?>"
                                                data-date="<?= $item['fecha'] ?>"
                                                data-building-name="<?= $item['nombre_local'] ?>"
                                                data-user="<?= $item['usuario'] ?? 'Sistema' ?>"
                                                data-provider="<?= $item['nombre_proveedor'] ?? '' ?>"
                                                data-receipt-type="<?= $item['tipo_comprobante'] ?? '' ?>"
                                                data-receipt-id="<?= $item['numero_recibo'] ?? '' ?>"
                                                data-items="<?= htmlspecialchars(json_encode($item['items'])) ?>"
                                            >
                                                <i class="bi bi-eye"></i>
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

    <nav class="navbar fixed-bottom bg-white border-top d-md-none shadow-lg" >
        <div class="container-fluid d-flex justify-content-around py-1">
            
            <a href="<?= BASE_URL ?>/stock" class="text-decoration-none text-secondary">
                <i class="bi bi-box-seam fs-3 d-block"></i>
            </a>

            <a href="<?= BASE_URL ?>/stock/movements" class="text-decoration-none text-danger">
                <i class="bi bi-arrow-left-right fs-1 d-block"></i>
            </a>

            <a href="<?= BASE_URL ?>/stock/item-templates" class="text-decoration-none text-secondary">
                <i class="bi bi-file-earmark-text fs-3 d-block"></i>
            </a>

            <a href="<?= BASE_URL ?>/stock/providers" class="text-decoration-none text-secondary">
                <i class="bi bi-truck fs-3 d-block"></i>
            </a>

            <a href="<?= BASE_URL ?>/stock/buildings" class="text-decoration-none text-secondary">
                <i class="bi bi-shop fs-3 d-block"></i>
            </a>

        </div>
    </nav>
</main>

<!-- FLASH - TOAST ALERTA -->
<?php if ($flash): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="flashToast" class="toast bg-<?= $flash["type"] ?>-subtle" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Avisos | Movimientos</strong>
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

<!-- Modal para registrar compra a proveedor -->
<div class="modal fade" id="modalRegistrarCompra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Registrar stock por compra a proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/movements/create">
                <div class="modal-body bg-light">
                    
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?? 1 ?>">

                    <div class="row g-5 mb-4">
                        <div class="col-md-5">
                            <label class="fw-bold">Local</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi bi-shop"></i>
                                </div>
                                <select class="form-select" name="building_id" required>
                                    <option selected disabled value="">Elija un local...</option>
                                    <?php foreach ($buildings as $local): ?>
                                        <option value="<?= $local['id'] ?>"><?= $local['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">Tipo de movimiento</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi bi-arrow-left-right"></i>
                                </div>
                                <select disabled class="form-select">
                                    <option selected>Compra a proveedor</option>
                                </select>
                            </div>
                            <input type="hidden" name="movement_reason" value="COMPRA_PROVEEDOR">
                        </div>

                    </div>
                    <div class="col-md-8 mb-4">
                        <label class="fw-bold">Proveedor</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="bi bi-truck"></i>
                            </div>
                            <select class="form-select" name="provider_id" required>
                                <option selected disabled value="">Elija un proveedor...</option>
                                <?php foreach ($providers as $item): ?>
                                    <option value="<?= $item['id_proveedor'] ?>"><?= $item['nombre_proveedor'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-5 mb-4">
                        <div class="col-md-4">
                            <label class="fw-bold">Tipo de comprobante</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <select class="form-select" name="receipt_type">
                                    <option selected disabled value="">Elija un tipo...</option>
                                    <option value="REMITO">Remito</option>
                                    <option value="FACTURA">Factura</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <label class="fw-bold">Número de comprobante</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi bi-123"></i>
                                </div>
                                <input type="text" class="form-control" name="receipt_number" placeholder="00001-123456">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <label class="fw-bold">Listado de Artículos</label>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="agregarFilaArticulo()">
                            <i class="bi bi-plus-lg"></i>
                            Agregar item
                        </button>
                    </div>

                    <div id="contenedor-articulos"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Registrar compra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para registrar ajuste manual -->
<div class="modal fade" id="modalRegistrarAjuste" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-sliders me-2"></i>
                    Registrar Ajuste de Stock
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/movements/create">
                <div class="modal-body">
                    
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?? 1 ?>">
                    
                    <input type="hidden" name="provider_id" value="">
                    <input type="hidden" name="receipt_type" value="">

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="fw-bold">Local Afectado</label>
                            <select class="form-select" name="building_id" required>
                                <option selected disabled value="">Seleccionar...</option>
                                <?php foreach ($buildings as $local): ?>
                                    <option value="<?= $local['id'] ?>"><?= $local['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="fw-bold">Motivo del Ajuste</label>
                            <select class="form-select" name="movement_reason" required>
                                <option selected disabled value="">Seleccionar causa...</option>
                                <option value="AJUSTE_MANUAL">Ajuste manual</option>
                                <option value="ROTURA">Rotura</option>
                                <option value="USO_INTERNO">Uso interno</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="fw-bold text-danger">Artículos</label>
                        <button type="button" class="btn btn-sm btn-outline-danger fw-bold" onclick="agregarFilaAjuste()">
                            <i class="bi bi-plus-lg"></i> Agregar Item
                        </button>
                    </div>

                    <div class="alert alert-light border border-danger small text-muted py-2 mb-3">
                        <i class="bi bi-info-circle-fill text-danger me-1"></i> 
                        Para <strong>descontar</strong> mercadería (ej: se rompió), poné el número en negativo (ej: <strong>-5</strong>).
                        Para <strong>agregar</strong>, usá positivo.
                    </div>

                    <div id="contenedor-items-ajuste"></div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar Ajuste</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para ver detalle de movimientos -->
<div class="modal fade" id="modalVerDetalleMovimiento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header text-white" id="headerDetalleMovimiento">
                <h5 class="modal-title">
                    <span id="iconoDetalle" class="me-2"></span>
                    <span id="detalleTitulo">Detalle de Movimiento</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                
                <div class="row mb-3 g-2">
                    <div class="col-6">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Fecha</small>
                        <span id="detalleFecha" class="fs-6"></span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Local</small>
                        <span id="detalleLocal" class="fs-6 fw-bold"></span>
                    </div>
                    <div class="col-12 mt-2">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Usuario</small>
                        <span id="detalleUsuario" class="fs-6"></span>
                    </div>
                </div>
                
                <div id="seccionDatosCompra" class="card bg-light border-0 mb-3 d-none">
                    <div class="card-body py-2 px-3">
                        <div class="row align-items-center">
                            <div class="col-1 text-center">
                                <i class="bi bi-receipt fs-3 text-secondary"></i>
                            </div>
                            <div class="col-11">
                                <h6 class="mb-0 fw-bold text-dark" id="detalleProveedor">Proveedor S.A.</h6>
                                <div class="small text-muted">
                                    <span id="detalleTipoComprobante">FACTURA A</span> N° <span id="detalleNumeroComprobante">0001</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light border small text-center mb-3 py-1" id="detalleMotivoBadge"></div>

                <h6 class="border-bottom pb-2 mb-2 fw-bold">Items Afectados</h6>
                
                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle mb-0">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th>Artículo</th>
                                <th class="text-end">Cant.</th>
                            </tr>
                        </thead>
                        <tbody id="detalleItemsBody"></tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer bg-light py-1">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para filtrar movimientos -->
<div class="modal fade" id="modalFiltrarMovimientos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered"> <div class="modal-content">
            <div class="modal-header bg-danger text-light py-2">
                <h6 class="modal-title fw-bold"><i class="bi bi-funnel me-2"></i>Filtrar Movimientos</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Local</label>
                    <select class="form-select form-select-sm" id="filtroLocal">
                        <option value="">Todos los locales</option>
                        <?php foreach ($buildings as $local): ?>
                            <option value="<?= $local['id'] ?>" 
                                <?= ($filters['building_id'] ?? '') == $local['id'] ? 'selected' : '' ?>>
                                <?= $local['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Desde</label>
                    <input type="date" class="form-control form-control-sm" id="filtroFechaDesde" 
                           value="<?= $filters['date_from'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Hasta</label>
                    <input type="date" class="form-control form-control-sm" id="filtroFechaHasta" 
                           value="<?= $filters['date_to'] ?? '' ?>">
                </div>

            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-sm btn-link text-decoration-none text-muted" onclick="limpiarFiltros()">
                    Limpiar
                </button>
                <button type="button" class="btn btn-sm btn-danger px-4" onclick="aplicarFiltros()">
                    Aplicar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Barra de búsqueda
    document.getElementById("buscadorStock").addEventListener("keyup", function() {
        let searchText = this.value.toLowerCase();
        let rows = document.querySelectorAll("#tablaStockBody tr");

        rows.forEach(row => {
            let nombre = row.cells[0].innerText.toLowerCase();
            
            if (nombre.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    
    
    // Funciones para agregar articulos en el modal de crear movimiento
    let contadorFilasArticulos = 0;
    function agregarFilaArticulo() {

        const contenedorArticulos = document.getElementById('contenedor-articulos');
        
        const nuevaFilaArticulo = document.createElement('div');
        nuevaFilaArticulo.className = 'row g-2 mb-2 align-items-center';
        
        let opcionesArticulos_Html = '<option selected disabled value="">Seleccionar...</option>';

        DATA_ITEM_TEMPLATES.forEach(item => {
            opcionesArticulos_Html += `<option value="${item.id_modelo_articulo}">
                                ${item.nombre_modelo_articulo} (${item.unidad_medida_modelo_articulo})
                            </option>`;
        });

        nuevaFilaArticulo.innerHTML = `
            <div class="col-8">
                <select class="form-select" name="items[${contadorFilasArticulos}][item_template_id]" required>
                    ${opcionesArticulos_Html}
                </select>
            </div>
            <div class="col-3">
                <input type="number" class="form-control" name="items[${contadorFilasArticulos}][quantity]" placeholder="Cantidad..." required>
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        `;

        contenedorArticulos.appendChild(nuevaFilaArticulo);
        contadorFilasArticulos++;
    }

    // Funciones para agregar artículos en el modal de registrar un movimiento de stock por ajuste manual
    let contadorFilasAjuste = 0;

    function agregarFilaAjuste() {
        const contenedor = document.getElementById('contenedor-items-ajuste');
        const nuevaFila = document.createElement('div');
        
        nuevaFila.className = 'row g-2 mb-2 align-items-center item-row';
        
        let opcionesHtml = '<option selected disabled value="">Seleccionar...</option>';

        DATA_ITEM_TEMPLATES.forEach(item => {
            opcionesHtml += `<option value="${item.id_modelo_articulo}">
                                ${item.nombre_modelo_articulo} (${item.unidad_medida_modelo_articulo})
                            </option>`;
        });

        nuevaFila.innerHTML = `
            <div class="col-8">
                <select class="form-select" name="items[${contadorFilasAjuste}][item_template_id]" required>
                    ${opcionesHtml}
                </select>
            </div>
            <div class="col-3">
                <input type="number" class="form-control" 
                    name="items[${contadorFilasAjuste}][quantity]" 
                    placeholder="-1" step="0.01" required>
            </div>
            <div class="col-1 text-center">
                <button type="button" class="btn btn-outline-danger" 
                        onclick="this.closest('.row').remove()">
                    <i class="bi bi-x-lg hover-danger fs-5"></i>
                </button>
            </div>
        `;

        contenedor.appendChild(nuevaFila);
        contadorFilasAjuste++;
    }

    // Cuando carga la página se agrega una fila vacía en ambos modales
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof DATA_ITEM_TEMPLATES !== "undefined" && DATA_ITEM_TEMPLATES.length > 0) {
            agregarFilaArticulo();
            agregarFilaAjuste();
        }
    });

    // Funciones para el modal de ver detalle del movimiento
    const modalVerDetalle = document.getElementById('modalVerDetalleMovimiento');

    if (modalVerDetalle) {
        modalVerDetalle.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            const motivo = button.getAttribute('data-movement-reason');
            const fecha = button.getAttribute('data-date');
            const local = button.getAttribute('data-building-name');
            const usuario = button.getAttribute('data-user') || 'Sistema';
            const proveedor = button.getAttribute('data-provider') || 'Desconocido';
            const tipoComp = button.getAttribute('data-receipt-type') || 'Comprobante';
            const idComp = button.getAttribute('data-receipt-id') || '-';
            
            const itemsJson = button.getAttribute('data-items');
            let items = [];
            try {
                items = JSON.parse(itemsJson);
            } catch (e) {
                console.error("Error al leer items", e);
                items = [];
            }
            
            const header = modalVerDetalle.querySelector('#headerDetalleMovimiento');
            const icono = modalVerDetalle.querySelector('#iconoDetalle');
            const titulo = modalVerDetalle.querySelector('#detalleTitulo');
            const cajaCompra = modalVerDetalle.querySelector('#seccionDatosCompra');

            header.classList.remove('bg-success', 'bg-warning', 'bg-danger', 'bg-secondary');
            icono.className = 'me-2 bi';

            if (motivo === 'COMPRA_PROVEEDOR') {
                header.classList.add('bg-success');
                icono.classList.add('bi-cart-check-fill');
                titulo.textContent = 'Detalle de Compra';
                cajaCompra.classList.remove('d-none');

                modalVerDetalle.querySelector('#detalleProveedor').textContent = proveedor;
                modalVerDetalle.querySelector('#detalleTipoComprobante').textContent = tipoComp;
                modalVerDetalle.querySelector('#detalleNumeroComprobante').textContent = idComp;

                header.classList.add('bg-success');
                titulo.textContent = 'Detalle de Compra';

            } else if (['ROTURA', 'PERDIDA', 'CONSUMO_INTERNO'].includes(motivo)) {
                header.classList.add('bg-danger');
                icono.classList.add('bi-exclamation-triangle-fill');
                titulo.textContent = 'Detalle de Baja';
                cajaCompra.classList.add('d-none');
            } else {
                header.classList.add('bg-secondary');
                icono.classList.add('bi-sliders');
                titulo.textContent = 'Detalle de Ajuste';
            }

            const fechaObj = new Date(fecha);
            modalVerDetalle.querySelector('#detalleFecha').textContent = fechaObj.toLocaleDateString() + ' ' + fechaObj.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            modalVerDetalle.querySelector('#detalleLocal').textContent = local;
            modalVerDetalle.querySelector('#detalleUsuario').textContent = usuario;
            modalVerDetalle.querySelector('#detalleMotivoBadge').innerHTML = `<strong>Motivo:</strong> ${motivo.replace('_', ' ')}`;

            const tbody = modalVerDetalle.querySelector('#detalleItemsBody');
            tbody.innerHTML = '';
            
            const tipoMovimiento = button.getAttribute('data-type');
            
            if (items.length === 0) {
                tbody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">Sin detalles registrados</td></tr>';
            } else {
                items.forEach(item => {
                    const cant = parseFloat(item.cantidad_movida);
                    
                    let esSalida = tipoMovimiento === 'OUT';

                    const colorClase = esSalida ? 'text-danger' : 'text-success';
                    const signo = esSalida ? '-' : '+';
                    const row = `
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">${item.nombre_modelo_articulo}</div>
                                <div class="small text-muted" style="font-size:0.75rem">${item.unidad_medida_modelo_articulo || 'u.'}</div>
                            </td>
                            <td class="text-end align-middle">
                                <span class="fs-5 fw-bold ${colorClase}">
                                    ${signo}${cant}
                                </span>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            }
        });
    }

    // Funciones para el modal de filtrar movimientos
    function aplicarFiltros() {
        const local = document.getElementById('filtroLocal').value;
        const desde = document.getElementById('filtroFechaDesde').value;
        const hasta = document.getElementById('filtroFechaHasta').value;

        const params = new URLSearchParams(window.location.search);

        if (local) params.set('building_id', local);
        else params.delete('building_id');

        if (desde) params.set('date_from', desde);
        else params.delete('date_from');

        if (hasta) params.set('date_to', hasta);
        else params.delete('date_to');

        window.location.search = params.toString();
    }

    function limpiarFiltros() {
        const baseUrl = window.location.pathname;
        window.location.href = baseUrl;
    }
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>