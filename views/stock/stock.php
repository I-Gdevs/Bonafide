<head>
    <title>Bonafide | Stock</title>
</head>

<?php include BASE_PATH . "/views/partials/head.php"; ?>
<?php include BASE_PATH . "/views/partials/header.php"; ?>
<?php $flash = getFlash(); ?>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        <div class="row g-4">
            <div class="col-md-3 d-none d-md-block">
                <div class="list-group">
                    <a href="<?= BASE_URL ?>/stock" 
                    class="list-group-item list-group-item-action active fw-bold">
                        <i class="bi bi-box-seam me-2"></i>
                        Mi stock
                    </a>
                    
                    <a href="<?= BASE_URL ?>/stock/movements" 
                    class="list-group-item list-group-item-action text-dark">
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
                        
                        <div class="d-flex align-items-center">
                            
                            <a class="btn btn-light me-2">
                                <i class="bi bi-filetype-pdf"></i>
                            </a>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        $localActual = "Todos";
                                        if (isset($filters["building_id"]) && $filters["building_id"] != "") {
                                            foreach ($buildings as $building) {
                                                if ($building["id"] == $filters["building_id"]) {
                                                    $localActual = $building["nombre"];
                                                    break;
                                                }
                                            }
                                        }
                                    ?>
                                    Local: <?= $localActual ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item <?= (!isset($filters["building_id"]) || $filters["building_id"] == "") ? "active" : "" ?>" href="?building_id=">Todos</a>
                                    </li>
                                    <?php foreach ($buildings as $item): ?>
                                        <?php
                                            $isActive = (isset($filters["building_id"]) && $filters["building_id"] == $item["id"]) ? "active" : "";
                                        ?>
                                        <li>
                                            <a class="dropdown-item <?= $isActive ?>" href="?building_id=<?= $item["id"] ?>">
                                                <?= $item["nombre"] ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="buscadorStock" placeholder="Buscar...">
                        </div>

                    </div>

                <div class="table-responsive d-none d-md-block">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Artículo</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <?php if (!isset($filters["building_id"]) || $filters["building_id"] == ""): ?>
                                    <th>Local</th>
                                <?php endif; ?>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaStockBody" class="align-middle">
                            <?php if (empty($stock)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No hay artículos cargados.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($stock as $item): ?>
                                    <tr>
                                        <td><?= $item["nombre_modelo_articulo"]?></td>
                                        <td class="<?= $item["cantidad_stock"] < $item["cantidad_minima_stock"] ? "text-danger fw-bold" : "" ?>"><?= $item["cantidad_stock"]?></td>
                                        <td><?= $item["unidad_medida_modelo_articulo"]?></td>
                                        <?php if (!isset($filters["building_id"]) || $filters["building_id"] == ""): ?>
                                            <td>
                                                <?= $item["nombre_local"] ?>
                                            </td>
                                        <?php endif; ?>
                                        <td class="text-start">
                                            <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarStock"
                                                data-id="<?= $item["id_stock"] ?>"
                                                data-nombre-modelo-articulo="<?= $item["nombre_modelo_articulo"] ?>"
                                                data-unidad="<?= $item["unidad_medida_modelo_articulo"] ?>"
                                                data-cantidad-minima-stock="<?= $item["cantidad_minima_stock"] ?>"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-md-none">
                    <?php foreach ($stock as $item): ?>
                        
                        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    
                                    <div style="max-width: 70%;">
                                        <h6 class="mb-1 fw-bold text-dark text-truncate">
                                            <?= $item['nombre_articulo'] ?>
                                        </h6>
                                        <div class="small text-muted">
                                            <i class="bi bi-shop me-1"></i> <?= $item['nombre_local'] ?>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <span class="d-block h4 mb-0 fw-bold text-danger">
                                            <?= $item['cantidad'] ?>
                                        </span>
                                        <span class="d-block small text-muted text-uppercase" style="font-size: 0.7rem;">
                                            <?= $item['unidad_medida'] ?>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"></div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom bg-white border-top d-md-none shadow-lg" >
        <div class="container-fluid d-flex justify-content-around py-1">
            
            <a href="<?= BASE_URL ?>/stock" class="text-decoration-none text-danger">
                <i class="bi bi-box-seam fs-1 d-block"></i>
            </a>

            <a href="<?= BASE_URL ?>/stock/movements" class="text-decoration-none text-secondary">
                <i class="bi bi-arrow-left-right fs-3 d-block"></i>
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

<!-- Modal para editar la cantidad mínima de los artículos -->
<div class="modal fade" id="modalEditarStock" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEditarStockLabel">Editar artículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/edit">
                <div class="modal-body">
                    <input type="hidden" name="id" id="input_id">

                    <div class="mb-3">
                        <label class="form-label">Nombre del artículo</label>
                        <input type="text" class="form-control" id="input_nombre" name="nombre" disabled>
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
                    
                    <div class="mb-3">
                        <label class="form-label">Cantidad mínima</label>
                        <input type="number" class="form-control" id="input_cantidad_minima" name="cantidad_minima_stock">
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

<!-- FLASH - TOAST ALERTA -->
<?php if ($flash): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="flashToast" class="toast bg-<?= $flash["type"] ?>-subtle" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Avisos | Modelos de artículos</strong>
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

<script>
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

// Rellenar modal para editar stock
    const modalEditarStock = document.getElementById("modalEditarStock");

    modalEditarStock.addEventListener("show.bs.modal", function (event) {
        const boton = event.relatedTarget;

        const id = boton.getAttribute("data-id");
        const nombre_modelo_articulo = boton.getAttribute("data-nombre-modelo-articulo");
        const unidad = boton.getAttribute("data-unidad");
        const cantidad_minima_stock = boton.getAttribute("data-cantidad-minima-stock");
        
        modalEditarStock.querySelector("#input_id").value = id;
        modalEditarStock.querySelector("#input_nombre").value = nombre_modelo_articulo;
        modalEditarStock.querySelector("#input_unidad").value = unidad;
        modalEditarStock.querySelector("#input_cantidad_minima").value = cantidad_minima_stock;
    });
</script>

<?php include BASE_PATH . "/views/partials/footer.php"; ?>