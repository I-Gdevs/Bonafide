<head>
    <title>Bonafide | Productos</title>
</head>

<?php 
include __DIR__ . '/../partials/head.php'; 
include __DIR__ . '/../partials/header.php'; 


$es_administrador = true; // Cambiar a false para simular un cliente
?>


<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h1 class="fw-bold m-0">Recetas Disponibles</h1>
            
            <?php if ($es_administrador): ?>
            <a href="<?= BASE_URL ?>/añadirReceta" class="btn btn-red action-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gear-fill me-2" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.13.44c-.2.63-.56.91-1.2.91h-2.12c-1.4 0-2.11 1.79-.71 3.19l.71.71c.3.3.4.7.4 1.1v2.12c0 1.4 1.79 2.11 3.19.71l.71-.71c.3-.3.7-.4 1.1-.4h2.12c1.4 0 2.11-1.79.71-3.19l-.71-.71c-.3-.3-.4-.7-.4-1.1v-2.12c0-1.4 1.79-2.11 3.19-.71l.71.71c.3.3.7.4 1.1.4h2.12c1.4 0 2.11-1.79.71-3.19l-.71-.71c-.3-.3-.4-.7-.4-1.1v-2.12c0-1.4-1.79-2.11-3.19-.71l-.71.71c-.3.3-.7.4-.4 1.1v2.12z"/>
                </svg>
                Armado de Recetas
            </a>
            <?php endif; ?>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
            
            <?php for ($i = 1; $i <= 8; $i++): ?>
            <div class="col">
                <div class="card recipe-card h-100">
                    <img src="https://img.freepik.com/foto-gratis/rebanada-pastel-queso-nueva-york_1232-2130.jpg?t=st=1764825793~exp=1764829393~hmac=191aaa7e627dff75f67e916a4512e928ffb85de0668de239ca4fc6d1e295bd18&w=1480" <?php //esto va dentro de src de la imagen echo $i; ?> 
                         class="card-img-top recipe-img" alt="Receta <?php echo $i; ?>">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">Título de la Receta <?php echo $i; ?></h5>
                        <p class="card-text text-muted small mb-3">
                            Una breve descripción de los ingredientes clave y el sabor.
                        </p>
                        
                        <a href="<?= BASE_URL ?>/receta<?php //echo $i; ?>" class="btn btn-outline-danger mt-auto">
                            Ver Receta
                        </a>
                    </div>
                </div>
            </div>
            <?php endfor; ?>

        </div>
        
    </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>