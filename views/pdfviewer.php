<?php 
include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 
?>

<style>
    main {
        flex: 1;
        padding: 0 !important; 
        display: flex; 
        flex-direction: column;
        align-items: center; 
        background-color: #f8f9fa; /* Fondo gris súper claro para que resalten las tarjetas */
    }
    
    /* ESTILOS NUEVOS: Tarjetas de control para la presentación */
    .action-dashboard {
        width: 100%;
        max-width: 1320px;
        padding: 25px 15px;
    }
    .action-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        cursor: pointer;
    }
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        background-color: #dc3545; /* Rojo Bonafide */
    }
    .action-card:hover .icon-card, 
    .action-card:hover .text-dark {
        color: white !important;
    }

    /* ESTILOS ORIGINALES: PDF */
    .pdf-viewer-container {
        flex-grow: 1; 
        width: 100%;
        max-width: 1320px; 
        display: flex;
        flex-direction: column;
        overflow: hidden; 
        margin: 0 auto;
        box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        background: white;
    }
    .pdf-iframe {
        border: none; 
        width: 100%; 
        flex-grow: 1; 
        min-height: 700px;
    }
</style>

<main>
    
    <div class="action-dashboard">
        <div class="row g-4 justify-content-center">
            
            <div class="col-6 col-md-3">
                <a href="https://prezi.com/p/my0f2whlidpd/?present=1" target="_blank" class="text-decoration-none">
                    <div class="card shadow-sm h-100 action-card border-0">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-easel2-fill fs-1 d-block mb-3 icon-card text-danger"></i>
                            <h6 class="fw-bold m-0 text-dark text-uppercase">Presentación</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="https://github.com/I-Gdevs/Bonafide" target="_blank" class="text-decoration-none">
                    <div class="card shadow-sm h-100 action-card border-0">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-github fs-1 d-block mb-3 icon-card text-danger"></i>
                            <h6 class="fw-bold m-0 text-dark text-uppercase">Código Fuente</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="<?= BASE_URL ?>/presentacion" class="text-decoration-none">
                    <div class="card shadow-sm h-100 action-card border-0">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-play-circle-fill fs-1 d-block mb-3 icon-card text-danger"></i>
                            <h6 class="fw-bold m-0 text-dark text-uppercase">Ver Animación</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="<?= BASE_URL ?>/cartel1" class="text-decoration-none">
                    <div class="card shadow-sm h-100 action-card border-0">
                        <div class="card-body text-center py-4">
                            <i class="bi bi-tv-fill fs-1 d-block mb-3 icon-card text-danger"></i>
                            <h6 class="fw-bold m-0 text-dark text-uppercase">Cartelería TV</h6>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <div class="pdf-viewer-container">
        <iframe 
            src="<?= BASE_URL ?>/docs/BonafideProyectoFinalAsplanattieImasMetodologíadeSistemas.pdf#view=TwoPage"
            class="pdf-iframe"
            title="Documentación de la Tesis"
            width="1320" height="820">
        </iframe>
    </div>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>