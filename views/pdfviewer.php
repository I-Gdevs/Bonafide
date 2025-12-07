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
    }
    .pdf-viewer-container {
        flex-grow: 1; 
        width: 100%;
        max-width: 1320px; 
        display: flex;
        flex-direction: column;
        overflow: hidden; 
        margin: 0 auto;
    }
    .pdf-iframe {
        border: none; 
        width: 100%; 
        flex-grow: 1; 
    }
</style>

<main>
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