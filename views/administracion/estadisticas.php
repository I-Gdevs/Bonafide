<?php 
// BLINDAJE PHP
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 2)); 
}
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

// SIMULACIÓN DE DATOS DE VENTA
$datos_dashboard = [
    'local_activo' => 'Tribunales',
    'ventas_hoy' => 150,
    'ingreso_promedio_diario' => 28333,
    'ingreso_total_mensual' => 850000,
    'dias_ultimo_stock' => 1,
    'categorias_venta' => [
        'Cafetería' => 45, 'Postres' => 30, 'Combos' => 15, 'Bebidas Frías' => 10,
    ],
    'ventas_diarias' => [
        'Lunes' => 90, 'Martes' => 110, 'Miércoles' => 150, 
        'Jueves' => 180, 'Viernes' => 250, 'Sábado' => 130, 'Domingo' => 50
    ],
    'productos_mas_vendidos' => [
        ['nombre' => 'Grano de café Especial', 'unidades' => 150],
        ['nombre' => 'Medialuna Congelada', 'unidades' => 120],
        ['nombre' => 'Torta Cheesecake', 'unidades' => 110],
        ['nombre' => 'Chocolate Bonafide', 'unidades' => 95],
        ['nombre' => 'Sándwich de Miga', 'unidades' => 80],
    ],
    'empleados' => ['Juan Pérez', 'Ana Gómez', 'Carlos Ruiz'],
    'sucursales' => ['Tribunales', 'Centro', 'Palermo'],
    // Nuevas opciones de filtro
    'estado_pedido' => ['Entregado', 'Pendiente', 'Cancelado'],
    'tipo_pedido' => ['Local', 'Delivery'],
];

// Constantes de Colores
$color_bonafide_rojo = '#e53935';
$color_bonafide_amarillo = '#FFC83D';

// Datos para CHART.JS (Codificados a JSON)
$chart_ventas_diarias_labels = json_encode(array_keys($datos_dashboard['ventas_diarias']));
$chart_ventas_diarias_data = json_encode(array_values($datos_dashboard['ventas_diarias']));
$chart_categorias_labels = json_encode(array_keys($datos_dashboard['categorias_venta']));
$chart_categorias_data = json_encode(array_values($datos_dashboard['categorias_venta']));
?>

<head>
    <title>Bonafide | Estadísticas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<style>
    /* Estilos del Dashboard (Mantener) */
    #admin-layout { display: flex; min-height: calc(100vh - 60px); }
    #admin-sidebar { width: 250px; flex-shrink: 0; background-color: white; border-right: 1px solid #ddd; padding: 20px 0; }
    #admin-content { flex-grow: 1; padding: 20px; background-color: #f8f9fa; }
    .sidebar-link { color: #333; padding: 10px 20px; display: block; text-decoration: none; transition: background-color 0.2s, color 0.2s; border-left: 4px solid transparent; font-weight: 500; }
    .sidebar-link:hover { background-color: #f0f0f0; color: #e53935; }
    .sidebar-link.active { background-color: #fcebeb; color: #e53935; font-weight: bold; border-left: 4px solid #e53935; }
    .kpi-card-row { border-radius: 8px; overflow: hidden; border: 1px solid #ddd; }
    .kpi-item { padding: 20px; background-color: white; border-right: 1px solid #eee; display: flex; flex-direction: column; justify-content: center; }
    .kpi-number { font-size: 2.5rem; font-weight: 800; color: <?= $color_bonafide_rojo ?>; }
    .kpi-label { font-size: 0.9rem; color: #6c757d; }
    .chart-container { border: 1px solid #ddd; border-radius: 8px; background-color: white; }
    .chart-header { padding: 12px 20px; font-weight: bold; border-bottom: 1px solid #eee; background-color: #f7f7f7; }
    .chart-content { padding: 15px; }
    .chart-small { height: 250px !important; }
    .best-seller-list .list-group-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; }
    .btn-red { background-color: <?= $color_bonafide_rojo ?>; color: white; }
    .btn-red:hover { background-color: #c0302c; color: white; }

    /* ⭐ CORRECCIÓN 1: CSS para Impresión (Reducir tamaño de KPI) ⭐ */
    @media print {
        /* Ocultar elementos innecesarios */
        #admin-sidebar, .btn, .modal { display: none !important; }
        .fixed-width-container { max-width: none !important; margin: 0 !important; }
        
        /* Asegurar que el contenido del dashboard se extienda al 100% */
        #admin-content { 
            padding: 0;
            width: 100% !important;
            float: none !important;
        }

        /* Reducir texto de KPI para que no se desborde */
        .kpi-number {
            font-size: 1.5rem !important;
        }
        .kpi-label {
            font-size: 0.7rem !important;
        }
        
        /* Ajustar el layout de gráficos para imprimir en una columna (si fuera necesario) */
        .row-cols-md-4 > .col, .col-lg-6 {
            width: 50% !important; /* Intentar mantener dos por fila para PDF */
            float: left;
        }
    }
</style>

<main>
    <div class="fixed-width-container mx-auto">
        <div id="admin-layout">
            
            <aside id="admin-sidebar">
                <h4 class="text-danger text-center mb-4">Bonafide Admin</h4>
                <nav>
                    <?php 
                    $admin_pages = [
                        ['name' => 'Estadísticas', 'icon' => 'bi-graph-up', 'active' => true],
                        ['name' => 'Recetas', 'icon' => 'bi-book', 'active' => false],
                        ['name' => 'Inventario', 'icon' => 'bi-box-seam', 'active' => false],
                        ['name' => 'Empleados', 'icon' => 'bi-person-workspace', 'active' => false],
                        ['name' => 'Sucursales', 'icon' => 'bi-shop', 'active' => false],
                        ['name' => 'Finanzas', 'icon' => 'bi-cash', 'active' => false],
                    ];
                    foreach ($admin_pages as $page): ?>
                        <a href="#" class="sidebar-link <?= $page['active'] ? 'active' : '' ?>">
                            <i class="bi <?= $page['icon'] ?> me-2"></i> <?= $page['name'] ?>
                        </a>
                    <?php endforeach; ?>
                </nav>
            </aside>

            <div id="admin-content">

                <div class="row mb-4 align-items-center">
                    <div class="col-6">
                        <h2 class="fw-bold m-0">Estadísticas Clave (<?= htmlspecialchars($datos_dashboard['local_activo']) ?>)</h2>
                    </div>
                    <div class="col-6 text-end d-flex justify-content-end">
                        
                        <button class="btn btn-outline-secondary me-2" onclick="refreshDashboard()">
                            <i class="bi bi-arrow-clockwise"></i> Actualizar
                        </button>

                        <button class="btn btn-outline-secondary me-2" onclick="window.print()">
                            <i class="bi bi-printer"></i> Imprimir
                        </button>

                        <button class="btn btn-red" data-bs-toggle="modal" data-bs-target="#filtroModal">
                            <i class="bi bi-funnel"></i> Filtros
                        </button>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-4 g-0 kpi-card-row shadow-sm mb-4">
                    <div class="col kpi-item">
                        <div class="kpi-number"><?= number_format($datos_dashboard['ventas_hoy'], 0, ',', '.') ?></div>
                        <div class="kpi-label">Ventas realizadas hoy</div>
                    </div>
                    <div class="col kpi-item">
                        <div class="kpi-number">$<?= number_format($datos_dashboard['ingreso_promedio_diario'], 0, ',', '.') ?></div>
                        <div class="kpi-label">Ingreso Promedio Diario</div>
                    </div>
                    <div class="col kpi-item">
                        <div class="kpi-number">$<?= number_format($datos_dashboard['ingreso_total_mensual'], 0, ',', '.') ?></div>
                        <div class="kpi-label">Ingreso Total Mes</div>
                    </div>
                    <div class="col kpi-item">
                        <div class="kpi-number text-success"><?= $datos_dashboard['dias_ultimo_stock'] ?> día</div>
                        <div class="kpi-label">Último stock cargado</div>
                    </div>
                </div>

                <div class="row g-3">
                    
                    <div class="col-lg-6">
                        <div class="chart-container shadow-sm h-100">
                            <div class="chart-header">Ventas por Días de la Semana</div>
                            <div class="chart-content">
                                <canvas id="VentasDiariasChart" class="chart-small"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="chart-container shadow-sm h-100">
                            <div class="chart-header">Distribución de Ventas por Categoría (%)</div>
                            <div class="chart-content d-flex justify-content-center">
                                <canvas id="CategoriasChart" class="chart-small" style="max-height: 250px;"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="chart-container shadow-sm h-100">
                            <div class="chart-header">Top 5 Productos Más Vendidos</div>
                            <div class="chart-content p-0">
                                <ul class="list-group list-group-flush best-seller-list">
                                    <?php foreach ($datos_dashboard['productos_mas_vendidos'] as $index => $producto): ?>
                                        <li class="list-group-item">
                                            <span class="fw-bold"><?= $index + 1 ?>. <?= htmlspecialchars($producto['nombre']) ?></span>
                                            <span class="text-muted"><?= number_format($producto['unidades'], 0, ',', '.') ?> unid</span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="chart-container shadow-sm h-100">
                            <div class="chart-header">Ventas por Tipo de Pedido</div>
                            <div class="chart-content">
                                <canvas id="TipoPedidoChart" class="chart-small"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="chart-container shadow-sm h-100">
                            <div class="chart-header">Ingresos Mensuales vs. Objetivo</div>
                            <div class="chart-content">
                                <canvas id="IngresosMensualesChart" class="chart-small"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="chart-container shadow-sm h-100">
                            <div class="chart-header">Conversión por Empleado</div>
                            <div class="chart-content">
                                <canvas id="ConversionEmpleadoChart" class="chart-small"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="filtroModal" tabindex="-1" aria-labelledby="filtroModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="filtroModalLabel"><i class="bi bi-funnel me-2"></i> Aplicar Filtros Avanzados</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="modal-date-range-start" class="form-label fw-bold small">Fecha Inicio</label>
                    <input type="date" id="modal-date-range-start" class="form-control form-control-sm">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="modal-date-range-end" class="form-label fw-bold small">Fecha Fin</label>
                    <input type="date" id="modal-date-range-end" class="form-control form-control-sm">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="modal-category-filter" class="form-label fw-bold small">Categoría de Venta</label>
                    <select id="modal-category-filter" class="form-select form-select-sm">
                        <option value="todos">Todas las categorías</option>
                        <?php foreach (array_keys($datos_dashboard['categorias_venta']) as $cat): ?>
                            <option value="<?= strtolower(str_replace(' ', '_', $cat)) ?>"><?= htmlspecialchars($cat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="modal-employee-filter" class="form-label fw-bold small">Empleado / Vendedor</label>
                    <select id="modal-employee-filter" class="form-select form-select-sm">
                        <option value="todos">Todos los empleados</option>
                        <?php foreach ($datos_dashboard['empleados'] as $emp): ?>
                            <option value="<?= strtolower(str_replace(' ', '_', $emp)) ?>"><?= htmlspecialchars($emp) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="modal-sucursal-filter" class="form-label fw-bold small">Sucursal</label>
                    <select id="modal-sucursal-filter" class="form-select form-select-sm">
                        <?php foreach ($datos_dashboard['sucursales'] as $sucursal): ?>
                            <option value="<?= strtolower($sucursal) ?>"><?= htmlspecialchars($sucursal) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="modal-estado-filter" class="form-label fw-bold small">Estado del Pedido</label>
                    <select id="modal-estado-filter" class="form-select form-select-sm">
                        <option value="todos">Todos los estados</option>
                        <?php foreach ($datos_dashboard['estado_pedido'] as $estado): ?>
                            <option value="<?= strtolower($estado) ?>"><?= htmlspecialchars($estado) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-red" onclick="applyFilters()">Aplicar Filtros</button>
      </div>
    </div>
  </div>
</div>
<script>
    // Almacenar las instancias de Chart para poder actualizarlas
    let charts = {};
    
    // Función para simular la recarga y actualización de datos (Punto 3)
    function refreshDashboard() {
        alert("Simulando recarga de datos del servidor. Se haría una petición AJAX aquí.");
        
        // Simular un cambio en los datos para demostrar que funciona
        const nuevoTotalVentas = Math.floor(Math.random() * 200) + 100;
        
        // Actualizar KPI (Ejemplo)
        document.querySelector('.kpi-item:first-child .kpi-number').textContent = nuevoTotalVentas.toLocaleString('es-AR');

        // Simular nuevos datos para el gráfico de Ventas Diarias
        const newDailyData = [
            Math.floor(Math.random() * 100) + 50,
            Math.floor(Math.random() * 100) + 50,
            Math.floor(Math.random() * 100) + 50,
            Math.floor(Math.random() * 100) + 50,
            Math.floor(Math.random() * 100) + 50,
            Math.floor(Math.random() * 100) + 50,
            Math.floor(Math.random() * 100) + 50
        ];
        
        // Actualizar Chart.js
        if (charts.VentasDiarias) {
            charts.VentasDiarias.data.datasets[0].data = newDailyData;
            charts.VentasDiarias.update();
        }
    }

    // Función para aplicar filtros (simulación)
    function applyFilters() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('filtroModal'));
        modal.hide();

        // En una aplicación real, los valores de los selects/inputs se envían al servidor
        // para obtener los nuevos datos y luego se llama a refreshDashboard() con esos nuevos datos.
        alert("Filtros aplicados. Se recargaría la página o los gráficos con datos filtrados.");
        
        // Simular recarga para ver el efecto
        refreshDashboard();
    }


    document.addEventListener('DOMContentLoaded', function() {
        
        const rojoBonafide = '<?= $color_bonafide_rojo ?>';
        const amarilloBonafide = '<?= $color_bonafide_amarillo ?>';
        
        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                title: { display: false }
            }
        };

        // Función para inicializar todos los gráficos
        function initializeCharts() {
            // --- GRÁFICO 1: Ventas por Días (Líneas) ---
            const VentasDiariasCtx = document.getElementById('VentasDiariasChart').getContext('2d');
            charts.VentasDiarias = new Chart(VentasDiariasCtx, {
                type: 'line',
                data: {
                    labels: <?= $chart_ventas_diarias_labels ?>,
                    datasets: [{
                        label: 'Unidades Vendidas',
                        data: <?= $chart_ventas_diarias_data ?>,
                        borderColor: rojoBonafide,
                        backgroundColor: 'rgba(229, 57, 53, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: baseOptions
            });

            // --- GRÁFICO 2: Distribución por Categoría (Dona) ---
            const CategoriasCtx = document.getElementById('CategoriasChart').getContext('2d');
            charts.Categorias = new Chart(CategoriasCtx, {
                type: 'doughnut',
                data: {
                    labels: <?= $chart_categorias_labels ?>,
                    datasets: [{
                        data: <?= $chart_categorias_data ?>,
                        backgroundColor: [
                            rojoBonafide, amarilloBonafide, '#6c757d', '#007bff'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: baseOptions
            });
            
            // --- GRÁFICO 4: Ventas por Tipo de Pedido (Barra) ---
            const TipoPedidoCtx = document.getElementById('TipoPedidoChart').getContext('2d');
            charts.TipoPedido = new Chart(TipoPedidoCtx, {
                type: 'bar',
                data: {
                    labels: ['Consumo Local', 'Delivery'],
                    datasets: [{
                        label: 'Porcentaje de Pedidos',
                        data: [65, 35],
                        backgroundColor: [amarilloBonafide, rojoBonafide],
                        borderWidth: 1
                    }]
                },
                options: {
                    ...baseOptions,
                    scales: {
                        y: { beginAtZero: true, max: 100 }
                    }
                }
            });

            // --- GRÁFICO 5 (Nuevo): Ingresos Mensuales vs. Objetivo (Simulación) ---
            const IngresosMensualesCtx = document.getElementById('IngresosMensualesChart').getContext('2d');
            charts.IngresosMensuales = new Chart(IngresosMensualesCtx, {
                type: 'bar',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
                    datasets: [
                        { label: 'Ingresos Reales', data: [50000, 60000, 85000, 75000], backgroundColor: rojoBonafide },
                        { label: 'Objetivo', data: [70000, 70000, 70000, 70000], type: 'line', borderColor: '#007bff', borderWidth: 2, fill: false }
                    ]
                },
                options: baseOptions
            });

            // --- GRÁFICO 6 (Nuevo): Conversión por Empleado (Simulación) ---
            const ConversionEmpleadoCtx = document.getElementById('ConversionEmpleadoChart').getContext('2d');
            charts.ConversionEmpleado = new Chart(ConversionEmpleadoCtx, {
                type: 'polarArea',
                data: {
                    labels: ['Juan P.', 'Ana G.', 'Carlos R.'],
                    datasets: [{
                        data: [35, 45, 20], 
                        backgroundColor: [rojoBonafide, amarilloBonafide, '#17a2b8'],
                    }]
                },
                options: baseOptions
            });
        }
        
        initializeCharts();
    });
</script>


<?php include BASE_PATH . '/views/partials/footer.php'; ?>