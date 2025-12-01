
<?php include __DIR__ . '/../partials/head.php'; ?>
<?php include __DIR__ . '/../partials/header.php'; ?>


<style>
.list-group-item {
    border: none;
    border-radius: 0;
}

/* Ajustar el padding y el color del texto para el estado inactivo */
.list-group-item:not(.active) a {
    font-weight: normal; 
}

/* 3. Asegurar el color de fondo azul para el activo (esto sobrescribe el fondo blanco) */
.list-group-item.active {
    background-color: #da3544; /* Color azul de Bootstrap (puedes ajustarlo si usas otro tono) */
    border-color: #007bff;
    color: white; /* Asegura el texto blanco para el activo */
}
</style>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <h1 class="mb-4">Movimientos de Stock por Local</h1>

        <div class="row g-4">
            
            <div class="col-md-3">
    <ul class="list-group list-unstyled-borders">
        
        <li class="list-group-item active">
            <a href="#" class="text-decoration-none text-white fs-5 fw-bold">Mi stock</a>
        </li>
        
        <li class="list-group-item">
            <a href="#" class="text-decoration-none text-dark">Movimientos</a>
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
                        <button class="btn btn-danger me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/><path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/></svg>
                        </button>
                        <button class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16"><path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/></svg>
                        </button>
                    </div>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Movimiento</th>
                                <th>Local</th>
                                <th>Fecha</th>
                                <th>Artículo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Egreso asociado a venta</td>
                                <td>Tribunales</td>
                                <td>11/02/2025</td>
                                <td>Café en granos</td>
                                <td class="text-danger fw-bold">-20 gr.</td>
                            </tr>
                            <tr>
                                <td>Ingreso por compra a proveedor</td>
                                <td>Peatonal</td>
                                <td>11/02/2025</td>
                                <td>Torta Cheesecake</td>
                                <td class="text-success fw-bold">+3 u.</td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>