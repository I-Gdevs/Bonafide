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
						<button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalCrearLocal">
							<i class="bi bi-plus-lg"></i>
						</button>
						<button class="btn btn-outline-secondary">
							<i class="bi bi-funnel"></i>
						</button>
					</div>

					<div class="col-sm-4">
						<input type="text" class="form-control" id="buscadorLocal" placeholder="Buscar...">
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
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody id="tablaStockBody">
							<?php if (empty($buildings)): ?>
								<tr>
									<td colspan="5" class="text-center py-4 text-muted">No hay ningún local cargado.</td>
								</tr>
							<?php else: ?>
								<?php foreach ($buildings as $item): ?>
									<tr>
										<td><?= $item["nombre"]?></td>
										<td><?= $item["direccion"]?></td>
										<td><?= $item["cantidad_empleados"]?></td>
										<td><?= $item["nombre_encargado"]?></td>
										<td class="text-end">
											<button class="btn btn-sm btn-danger"
												data-bs-toggle="modal"
												data-bs-target="#modalEditarLocal"
												data-id="<?= $item['id'] ?>"
												data-nombre="<?= $item['nombre'] ?>"
												data-direccion="<?= $item['direccion'] ?>"
												data-cantidad-empleados="<?= $item['cantidad_empleados'] ?>"
												data-encargado="<?= $item['nombre_encargado'] ?>"
												data-id-encargado="<?= $item['id_encargado'] ?>"
											>
												<i class="bi bi-pencil-square"></i>
											</button>
											<button class="btn btn-sm btn-outline-danger"
												data-bs-toggle="modal"
												data-bs-target="#modalEliminarLocal"
												data-id="<?= $item['id'] ?>"
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
</main>

<!-- Modal para la creación de locales -->
<div class="modal fade" id="modalCrearLocal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">Crear nuevo Local</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form method="POST" action="<?= BASE_URL ?>/stock/buildings">
				<div class="modal-body">

					<div class="mb-3">
						<label class="form-label">Nombre</label>
						<input type="text" class="form-control" id="input_nombre" name="nombre" required>
					</div>

					<div class="mb-3">
						<label class="form-label">Dirección</label>
						<input type="text" class="form-control" id="input_direccion" name="direccion" required>
					</div>

					<div class="mb-3">
						<label class="form-label">Cantidad de empleados</label>
						<input type="text" class="form-control" id="input_cantidad_empleados" name="cantidad_empleados" required>
					</div>

					<div class="mb-3">
						<label class="form-label">Encargado del local</label>
						<select class="form-select" id="input_encargado" name="encargado" required>
							<option selected disabled>Seleccione empleado</option>
							<?php if (!empty($users)): ?>
								<?php foreach ($users as $user): ?>
									<option value="<?= $user["id"] ?>">
										<?= $user["name"] ?>
									</option>
								<?php endforeach; ?>
							<?php else: ?>
								<option disabled>No hay empleados disponibles</option>
							<?php endif; ?>
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


<!-- Modal para la edición de locales -->
<div class="modal fade" id="modalEditarLocal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">Editar local</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form method="POST" action="<?= BASE_URL ?>/stock/buildings/edit">
				<div class="modal-body">
					<input type="hidden" name="id" id="input_id">

					<div class="mb-3">
						<label class="form-label">Nombre</label>
						<input type="text" class="form-control" id="input_nombre" name="nombre" required>
					</div>

					<div class="mb-3">
						<label class="form-label">Dirección</label>
						<input type="text" class="form-control" id="input_direccion" name="direccion" required>
					</div>

					<div class="mb-3">
						<label class="form-label">Cantidad de empleados</label>
						<input type="text" class="form-control" id="input_cantidad_empleados" name="cantidad_empleados" required>
					</div>

					<div class="mb-3">
						<label class="form-label">Encargado del local</label>
						<select class="form-select" id="input_encargado" name="encargado" required>
							<option disabled>Seleccione empleado</option>
							<?php if (!empty($users)): ?>
								<?php foreach ($users as $user): ?>
									<option value="<?= $user["id"] ?>">
										<?= $user["name"] ?>
									</option>
								<?php endforeach; ?>
							<?php else: ?>
								<option disabled>No hay empleados disponibles</option>
							<?php endif; ?>
						</select>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para eliminar locales -->
<div class="modal fade" id="modalEliminarLocal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">Eliminar local</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form method="POST" action="<?= BASE_URL ?>/stock/buildings/delete">
				<div class="modal-body">
					<input type="hidden" name="id" id="input_id">

					¿Está seguro que desea eliminar el local?
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-secondary">Eliminar</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	// Buscador
	document.getElementById('buscadorLocal').addEventListener('keyup', function() {
		let searchText = this.value.toLowerCase();
		let rows = document.querySelectorAll('#tablaStockBody tr');

		rows.forEach(row => {
			let nombre = row.innerText.toLowerCase();

			if (nombre.includes(searchText)) {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
		});
	});


	// Rellenar modal para editar locales
	const modalEditarLocal = document.getElementById("modalEditarLocal");

	modalEditarLocal.addEventListener('show.bs.modal', function (event) {
		const boton = event.relatedTarget;

		const id = boton.getAttribute('data-id');
		const nombre = boton.getAttribute('data-nombre');
		const direccion = boton.getAttribute('data-direccion');
		const cantidad_empleados = boton.getAttribute('data-cantidad-empleados');
		const id_encargado = boton.getAttribute('data-id-encargado');
		
		modalEditarLocal.querySelector('#input_id').value = id;
		modalEditarLocal.querySelector('#input_nombre').value = nombre;
		modalEditarLocal.querySelector('#input_direccion').value = direccion;
		modalEditarLocal.querySelector('#input_cantidad_empleados').value = cantidad_empleados;
		modalEditarLocal.querySelector('#input_encargado').value = id_encargado;
	});

	// Rellenar modal para eliminar locales
	const modalEliminarLocal = document.getElementById("modalEliminarLocal");

	modalEliminarLocal.addEventListener('show.bs.modal', function (event) {
		const boton = event.relatedTarget;

		const id = boton.getAttribute('data-id');
		
		modalEliminarLocal.querySelector('#input_id').value = id;
	});
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>