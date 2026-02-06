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
                                                data-batch-id="<?= $item['id_lote_movimiento'] ?>"
                                                data-movement-reason="<?= $item["motivo_movimiento"] ?>"
                                                data-date="<?= $item['fecha'] ?>"
                                                data-building-name="<?= $item['nombre_local'] ?>"
                                                data-user="<?= $item['usuario'] ?>"
                                                data-items="<?= htmlspecialchars(json_encode($item['items'])) ?>"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-<?= $item["modelo_articulo_desactivado_bool"] ? "secondary" : "danger" ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEliminarModeloArticulo"
                                                data-id="<?= $item['id_modelo_articulo'] ?>"
                                                <?= $item["modelo_articulo_desactivado_bool"] ? "disabled" : "enabled" ?>
                                            >
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
                                <input type="text" class="form-control" name="reference_id">
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
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Detalle de Operación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body bg-light">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">Motivo</small>
                                <div class="fw-bold fs-5" id="modalMotivo">...</div>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted">Fecha</small>
                                <div class="fw-bold" id="modalFecha">...</div>
                            </div>
                            <div class="col-12 mt-2">
                                <small class="text-muted">Usuario: </small>
                                <span class="fw-bold" id="modalUsuario">...</span> | 
                                <small class="text-muted">Local: </small>
                                <span class="fw-bold" id="modalLocal">...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Artículo</th>
                                    <th class="text-end">Cantidad Movida</th> 
                                </tr>
                            </thead>
                            <tbody id="modalTablaCuerpo">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cerrar</button>
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
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>