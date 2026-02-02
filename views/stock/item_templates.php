<head>
    <title>Bonafide | Modelos de Artículos</title>
</head>

<?php include BASE_PATH . "/views/partials/head.php"; ?>
<?php include BASE_PATH . "/views/partials/header.php"; ?>
<?php $flash = getFlash(); ?>

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

                    <a href="<?= BASE_URL ?>/stock/item-templates" 
                    class="list-group-item list-group-item-action active fw-bold">
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
                        <button class="btn btn-danger me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalCrearModeloArticulo"
                        >
                            <i class="bi bi-plus-lg"></i>
                        </button>

                        <button class="btn btn-outline-secondary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalFiltrarModeloArticulo"
                        >
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
                            <?php if (empty($itemTemplates)): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">No hay ningún modelo de artículo.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($itemTemplates as $item): ?>
                                    <tr>
                                        <td><?= $item["nombre_modelo_articulo"]?></td>
                                        <td><?= $item["unidad_medida_modelo_articulo"]?></td>
                                        <td class="text-start">
                                            <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarModeloArticulo"
                                                data-id="<?= $item['id_modelo_articulo'] ?>"
                                                data-nombre="<?= $item['nombre_modelo_articulo'] ?>"
                                                data-unidad="<?= $item['unidad_medida_modelo_articulo'] ?>"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-<?= $item["modelo_articulo_desactivado_bool"] ? "secondary" : "danger" ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEliminarModeloArticulo"
                                                data-id="<?= $item['id_modelo_articulo'] ?>"
                                                <?= $item["modelo_articulo_desactivado_bool"] ? "disabled" : "enabled" ?>
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <?php if ($item["modelo_articulo_desactivado_bool"]): ?>
                                                <button class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalRestaurarModeloArticulo"
                                                data-id="<?= $item['id_modelo_articulo'] ?>"
                                                >
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDestruirModeloArticulo"
                                                data-id="<?= $item['id_modelo_articulo'] ?>"
                                            >
                                                <i class="bi bi-x-square"></i>
                                            </button>
                                            <?php endif; ?>
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

<!-- Modal para crear modelos de artículos -->
 <div class="modal fade" id="modalCrearModeloArticulo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Crear nuevo Modelo de Artículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/item-templates">
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

<!-- Modal para filtrar modelos de artículos -->
 <div class="modal fade" id="modalFiltrarModeloArticulo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Filtrar modelos de artículos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="GET" action="">
                <div class="modal-body">
                    <p class="mb-2">Estado del artículo</p>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="item_template_disabled" id="radioActive" value="0"
                            <?= (!isset($_GET['item_template_disabled']) || $_GET['item_template_disabled'] === '0') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="radioActive">Solo Activos</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="item_template_disabled" id="radioInactive" value="1"
                            <?= (isset($_GET['item_template_disabled']) && $_GET['item_template_disabled'] === '1') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="radioInactive">Solo Eliminados</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="item_template_disabled" id="radioAll" value=""
                            <?= (isset($_GET['item_template_disabled']) && $_GET['item_template_disabled'] === '') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="radioAll">Ver Todos</label>
                    </div>

                    <?php if(!empty($_GET['search'])): ?>
                        <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search']) ?>">
                    <?php endif; ?>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para editar modelos de artículos -->
<div class="modal fade" id="modalEditarModeloArticulo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEditarArticuloLabel">Editar Modelo de Artículo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="<?= BASE_URL ?>/stock/item-templates/edit">
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
                            <option value="kg">kilogramos (kg)</option>
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

<!-- Modal para eliminar modelos de artículos -->
<div class="modal fade" id="modalEliminarModeloArticulo" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">Eliminar modelo de artículo</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form method="POST" action="<?= BASE_URL ?>/stock/item-templates/delete">
				<div class="modal-body">
					<input type="hidden" name="id" id="input_id">
					¿Está seguro que desea eliminar el modelo de artículo?
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-secondary">Eliminar</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para restaurar modelos de artículos -->
<div class="modal fade" id="modalRestaurarModeloArticulo" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">Restaurar modelo de artículo</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form method="POST" action="<?= BASE_URL ?>/stock/item-templates/restore">
				<div class="modal-body">
					<input type="hidden" name="id" id="input_id">
					¿Está seguro que desea restaurar el modelo de artículo?
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger">Restaurar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para destruir modelos de artículos -->
<div class="modal fade" id="modalDestruirModeloArticulo" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">Destruir modelo de artículo</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form method="POST" action="<?= BASE_URL ?>/stock/item-templates/destroy">
				<div class="modal-body">
					<input type="hidden" name="id" id="input_id">
					¿Está seguro que desea eliminar definitivamente el modelo de artículo?
				</div>

				<div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-warning">Destruir</button>
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

    // Rellenar modal para editar modelos de artículos
    const modalEditarModeloArticulo = document.getElementById("modalEditarModeloArticulo");

    modalEditarModeloArticulo.addEventListener("show.bs.modal", function (event) {
        const boton = event.relatedTarget;

        const id = boton.getAttribute("data-id");
        const nombre = boton.getAttribute("data-nombre");
        const unidad = boton.getAttribute("data-unidad");
        
        modalEditarModeloArticulo.querySelector("#input_id").value = id;
        modalEditarModeloArticulo.querySelector("#input_nombre").value = nombre;
        modalEditarModeloArticulo.querySelector("#input_unidad").value = unidad;
    });
    
    // Rellenar modal para eliminar modelos de artículos
	const modalEliminarModeloArticulo = document.getElementById("modalEliminarModeloArticulo");

	modalEliminarModeloArticulo.addEventListener("show.bs.modal", function (event) {
		const boton = event.relatedTarget;

		const id = boton.getAttribute("data-id");
		
		modalEliminarModeloArticulo.querySelector("#input_id").value = id;
	});

    // Rellenar modal para restaurar modelos de artículos
	const modalRestaurarModeloArticulo = document.getElementById("modalRestaurarModeloArticulo");

	modalRestaurarModeloArticulo.addEventListener("show.bs.modal", function (event) {
		const boton = event.relatedTarget;

		const id = boton.getAttribute("data-id");
		
		modalRestaurarModeloArticulo.querySelector("#input_id").value = id;
	});
    
    // Rellenar modal para desruir modelos de artículos
	const modalDestruirModeloArticulo = document.getElementById("modalDestruirModeloArticulo");

	modalDestruirModeloArticulo.addEventListener("show.bs.modal", function (event) {
		const boton = event.relatedTarget;

		const id = boton.getAttribute("data-id");
		
		modalDestruirModeloArticulo.querySelector("#input_id").value = id;
	});

</script>

<?php include BASE_PATH . "/views/partials/footer.php"; ?>