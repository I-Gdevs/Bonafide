<head>
    <title>Bonafide | Estadísticas</title>
</head>

<?php 
// Incluimos el head (con estilos) y el header (navegación)
include __DIR__ . '/../partials/head.php'; 
include __DIR__ . '/../partials/header.php'; 
?>



<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0 me-3">Tribunales</h2>
            <button class="btn btn-red">Cambiar Local</button>
        </div>

        <div class="row g-4">
            
            <div class="col-md-2 filter-menu">
                <h5 class="mb-2">Filtros</h5>
                <ul class="list-group list-group-flush filter-list">
                    <li class="list-group-item active">Local</li>
                    <li class="list-group-item">Empleados</li>
                    </ul>
            </div>

            <div class="col-md-10">
                <div class="row row-cols-1 row-cols-md-3 g-0 kpi-card-row shadow-sm">
                    
                    <div class="col kpi-item">
                        <div class="kpi-number">150+</div>
                        <div class="kpi-label">Ventas realizadas hoy</div>
                    </div>
                    
                    <div class="col kpi-item">
                        <div class="kpi-number">700+</div>
                        <div class="kpi-label">Ventas semana pasada</div>
                    </div>
                    
                    <div class="col kpi-item">
                        <div class="kpi-number text-success">1 día</div>
                        <div class="kpi-label">último stock cargado</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-4 mt-4">
            
            <div class="col-lg-7">
                <div class="chart-container shadow-sm h-100">
                    <div class="chart-header">Ventas por días</div>
                    <div class="chart-content" style="height: 350px; background-color: white;">
                        <p class="text-center text-muted pt-5">
                            [Área para Gráfico de Líneas de Ventas Diarias]
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="chart-container shadow-sm h-100">
                    <div class="chart-header">Más vendido</div>
                    <div class="chart-content p-0">
                        <ul class="list-group list-group-flush best-seller-list">
                            <li class="list-group-item">
                                <span class="fw-bold">1. Granos de café</span>
                                <span class="text-muted">150 unid</span>
                            </li>
                            <li class="list-group-item">
                                <span class="fw-bold">2. Azúcar</span>
                                <span class="text-muted">120 unid</span>
                            </li>
                             <li class="list-group-item">
                                <span class="fw-bold">3. Medialunas congeladas</span>
                                <span class="text-muted">110 unid</span>
                            </li>
                            <li class="list-group-item">
                                <span class="fw-bold">4. Leche</span>
                                <span class="text-muted">95 unid</span>
                            </li>
                            <li class="list-group-item">
                                <span class="fw-bold">5. Torta cheesecake</span>
                                <span class="text-muted">80 unid</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>