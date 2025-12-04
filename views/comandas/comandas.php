<head>
    <title>Bonafide | Comandas</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<style>
    /* Asegurar ancho fijo de 1000px */
    .fixed-width-container {
        max-width: 1320px !important;
    }

    /* --- ESTILOS DEL MENÚ LATERAL (REFERENCIAS) --- */
    /* Replicamos el estilo limpio de Stock */
    .sidebar-title {
        font-weight: 700;
        margin-bottom: 1rem;
        padding-left: 1.25rem; /* Alineado con los items */
        text-transform: uppercase;
        font-size: 0.9rem;
        color: #6c757d;
    }
    .legend-item {
        border: none;
        padding-left: 1.25rem;
        background: transparent;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
        color: #333;
    }
    /* Cuadraditos de color para la referencia */
    .color-box {
        width: 15px;
        height: 15px;
        border-radius: 4px;
        display: inline-block;
        border: 1px solid #dee2e6;
    }

    /* --- ESTILOS DE TARJETAS KDS --- */
    .kds-card {
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        /* Sombra suave */
        box-shadow: 0 2px 4px rgba(0,0,0,0.02); 
        height: 100%;
        display: flex;
        flex-direction: column;
        font-size: 0.85rem; /* Texto un poco más chico para que entre en 4 columnas */
    }

    /* Encabezados de Colores */
    .kds-header {
        padding: 6px 10px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
    }

    /* COLORES DE ESTADO */
    /* A Preparar (Rojo Suave) */
    .header-preparar { background-color: #fde8e8; color: #c0392b; border-bottom: 2px solid #c0392b; }
    /* A Entregar (Verde Suave) */
    .header-entregar { background-color: #d1e7dd; color: #198754; border-bottom: 2px solid #198754; }
    /* Entregadas (Gris) */
    .header-entregado { background-color: #e9ecef; color: #6c757d; border-bottom: 2px solid #6c757d; }
    /* Nuevas (Blanco/Borde Gris) */
    .header-new { background-color: #fff; color: #333; border-bottom: 2px solid #333; }
    /* Tiempo Cumplido (Amarillo) */
    .header-warning { background-color: #fff3cd; color: #856404; border-bottom: 2px solid #ffc107; }


    .kds-body {
        padding: 8px;
        flex: 1;
    }

    /* Checkboxes tachados */
    .form-check-input:checked + .form-check-label {
        text-decoration: line-through;
        color: #adb5bd;
    }
    .form-check-label { cursor: pointer; }

    /* Títulos de Sección */
    .section-header {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Botón Timbre y Historial */
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
    }
</style>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <h1 class="mb-4">Monitor de Cocina</h1>

        <div class="row g-4">
            
            <div class="col-md-3">
                <div class="sidebar-title">Referencias</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item legend-item">
                        <span class="color-box bg-white border-dark"></span> Recién llegada
                    </li>
                    <li class="list-group-item legend-item">
                        <span class="color-box bg-warning"></span> Tiempo cumplido
                    </li>
                    <li class="list-group-item legend-item">
                        <span class="color-box bg-danger"></span> Atrasado
                    </li>
                    <li class="list-group-item legend-item">
                        <span class="color-box bg-success"></span> Listo para entrega
                    </li>
                    <li class="list-group-item legend-item">
                        <span class="color-box bg-secondary"></span> Cancelado
                    </li>
                </ul>
            </div>

            <div class="col-md-9">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <select class="form-select form-select-sm fw-bold border-danger text-danger">
                            <option selected>Tribunales</option>
                            <option>Peatonal</option>
                            <option>Shopping</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm action-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.79-.613a8 8 0 0 1 .926 1.135l-.936.418a7 7 0 0 0-.127-.144zm.908 2.212a7 7 0 0 0-.123-.153l.939-.42a8 8 0 0 1 .302 1.036l-.986.18a7 7 0 0 0-.132-.643zm-12.26-2.23 1.258.85a7 7 0 0 1 .253-.306l-.954-.85a8 8 0 0 0-.557.306m-.87 1.258a7 7 0 0 1-.306-.253l-.85.954a8 8 0 0 0 .306.557l.85-1.258m-.253 1.258-.954-.85a8 8 0 0 0-.306.557l1.258.85a7 7 0 0 1 .253-.306m.85 1.258-.85 1.258a7 7 0 0 1 .306.253l.954-.85a8 8 0 0 0-.557-.306m1.258.85 1.258-.85a7 7 0 0 1 .253.306l-.954.85a8 8 0 0 0-.306-.557"/><path d="M8 5.5a.5.5 0 0 1 .5.5v4.793l3.146 3.147a.5.5 0 0 1-.708.708l-3.5-3.5A.5.5 0 0 1 7.5 10.5V6a.5.5 0 0 1 .5-.5"/></svg>
                            Historial
                        </button>

                        <button class="btn btn-warning btn-sm action-btn shadow-sm" onclick="alert('🔔 Timbre sonando en mostrador...')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/></svg>
                            Timbre
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="section-header text-danger">
                        <i class="bi bi-fire"></i> A Preparar
                    </div>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-2">
                        
                        <div class="col">
                            <div class="kds-card border-danger">
                                <div class="kds-header bg-danger text-white">
                                    <span>08:40</span>
                                    <span>16:30 <i class="bi bi-stopwatch"></i></span>
                                </div>
                                <div class="kds-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c1-1">
                                        <label class="form-check-label fw-bold" for="c1-1">1 Café Expresso</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c1-2">
                                        <label class="form-check-label" for="c1-2">6 Tostados</label>
                                    </div>
                                </div>
                                <div class="p-2 border-top">
                                    <button class="btn btn-danger btn-sm w-100 py-0">Listo</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="kds-card border-warning">
                                <div class="kds-header header-warning">
                                    <span>08:50</span>
                                    <span>06:45 <i class="bi bi-stopwatch"></i></span>
                                </div>
                                <div class="kds-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c2-1">
                                        <label class="form-check-label" for="c2-1">1 Capuccino</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c2-2">
                                        <label class="form-check-label" for="c2-2">1 Medialuna</label>
                                    </div>
                                </div>
                                <div class="p-2 border-top">
                                    <button class="btn btn-warning btn-sm w-100 py-0 text-white">Listo</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="kds-card">
                                <div class="kds-header header-new">
                                    <span>08:53</span>
                                    <span>03:30 <i class="bi bi-stopwatch"></i></span>
                                </div>
                                <div class="kds-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c3-1">
                                        <label class="form-check-label" for="c3-1">1 Café Expresso</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c3-2">
                                        <label class="form-check-label" for="c3-2">2 Medialunas</label>
                                    </div>
                                </div>
                                <div class="p-2 border-top">
                                    <button class="btn btn-outline-dark btn-sm w-100 py-0">Listo</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="kds-card">
                                <div class="kds-header header-new">
                                    <span>08:56</span>
                                    <span>00:30 <i class="bi bi-stopwatch"></i></span>
                                </div>
                                <div class="kds-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c4-1">
                                        <label class="form-check-label" for="c4-1">1 Capuccino</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="c4-2">
                                        <label class="form-check-label" for="c4-2">6 Tostados</label>
                                    </div>
                                </div>
                                <div class="p-2 border-top">
                                    <button class="btn btn-outline-dark btn-sm w-100 py-0">Listo</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mb-4">
                    <div class="section-header text-success">
                        <i class="bi bi-check-circle"></i> A Entregar
                    </div>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-2">
                        
                        <div class="col">
                            <div class="kds-card border-success">
                                <div class="kds-header header-entregar">
                                    <span>08:50</span>
                                    <span>06:45 <i class="bi bi-stopwatch"></i></span>
                                </div>
                                <div class="kds-body">
                                    <ul class="list-unstyled m-0">
                                        <li><i class="bi bi-check2"></i> 1 Café Expresso</li>
                                        <li><i class="bi bi-check2"></i> 2 Medialunas</li>
                                    </ul>
                                </div>
                                <div class="p-2 border-top">
                                    <button class="btn btn-success btn-sm w-100 py-0">Entregado</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mb-4">
                    <div class="section-header text-secondary">
                        <i class="bi bi-archive"></i> Entregadas / Histórico
                    </div>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-2">
                        
                        <div class="col">
                            <div class="kds-card opacity-75">
                                <div class="kds-header header-entregado">
                                    <span>08:50</span>
                                    <span>Finalizado</span>
                                </div>
                                <div class="kds-body bg-light">
                                    <ul class="list-unstyled m-0 text-muted">
                                        <li>1 Café Expresso</li>
                                        <li>2 Medialunas</li>
                                    </ul>
                                </div>
                                <div class="p-2 border-top">
                                    <button class="btn btn-secondary btn-sm w-100 py-0 disabled">Cerrado</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>