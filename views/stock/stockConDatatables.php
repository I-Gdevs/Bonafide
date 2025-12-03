<?php 
// Asegúrate de que la ruta sea correcta: subir un nivel (..) para acceder a partials
include '../partials/head.php'; 
include '../partials/header.php'; 
?>

<style>
/* Limita el ancho del contenedor principal a 1000px y lo centra (usado en el div.container) */
.fixed-width-container {
    max-width: 1000px !important;
}

/* Estilos para el menú lateral (Heredados y actualizados) */
.list-group-item {
    border: none;
    border-radius: 0;
}
.list-group-item:not(.active) a {
    font-weight: normal; 
}
.list-group-item.active {
    background-color: #da3544; 
    border-color: #007bff; /* Aunque el fondo es rojo, mantenemos el color de borde de referencia */
    color: white; 
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

                    </div>

                <div class="table-responsive">
                    <table id="stockTable" class="table table-striped table-hover">
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
                            <tr><td>Egreso asociado a venta</td><td>Tribunales</td><td>11/02/2025</td><td>Café en granos</td><td class="text-danger fw-bold">-20 gr.</td></tr>
                            <tr><td>Ingreso por compra a proveedor</td><td>Peatonal</td><td>11/02/2025</td><td>Torta Cheesecake</td><td class="text-success fw-bold">+3 u.</td></tr>
                            <tr><td>Ingreso manual</td><td>Tribunales</td><td>11/02/2025</td><td>Azúcar</td><td class="text-danger fw-bold">-1 kg</td></tr>
                            <tr><td>Egreso asociado a venta</td><td>Peatonal</td><td>10/02/2025</td><td>Pan de miga</td><td class="text-danger fw-bold">-500 gr.</td></tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof DataTable !== 'undefined') {
            new DataTable('#stockTable', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json' 
                },
                paging: true,
                ordering: true,
                info: true
            });
            
            //Oculta el buscador HTML que ya no necesitas
            const buscadorAntiguo = document.querySelector('.col-sm-4 input[type="text"]');
            if(buscadorAntiguo) {
                buscadorAntiguo.style.display = 'none';
            }
        }
    });
</script>

<?php include '../partials/footer.php'; ?>