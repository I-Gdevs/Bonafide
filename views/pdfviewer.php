<head>
    <title>Bonafide | Pedir</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<style>
    main {
        flex: 1;
        padding-top: 0 !important; 
        padding-bottom: 0 !important; 
        display: flex; 
        flex-direction: column;
    }

    .pdf-viewer-container {
        flex-grow: 1; 
        height: 100vh; 
        width: 100%;
        overflow: hidden; 
    }

    .pdf-iframe {
        border: none; 
        width: 100%;
        height: 100%;
    }
</style>

<main>
    <div class="pdf-viewer-container">
        
        <div class="p-3 bg-white shadow-sm d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0 text-dark">Documentación del Proyecto (PDF)</h5>
            <span class="badge bg-danger">Versión Final</span>
        </div>
        
        <iframe 
            src="<?= BASE_URL ?>/pdf"
            class="pdf-iframe"
            title="Documentación de la Tesis">
        </iframe>
        
    </div>
</main>



<?php include BASE_PATH . '/views/partials/footer.php'; ?>