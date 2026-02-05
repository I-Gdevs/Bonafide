<head>
    <title>Bonafide | Home</title>
</head>

<?php 
include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 


$productos_destacados = [
    ['nombre' => 'Cappuccino Clásico', 
    'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg', 
    'precio' => 3500, 
    'descripcion' => 'La cremosidad perfecta.'
    ],
    ['nombre' => 'Torta Bonafide', 
    'imagen' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80', 
    'precio' => 5800, 
    'descripcion' => 'Exclusivo blend de chocolate.'
    ],
    ['nombre' => 'Blend Expreso', 
    'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg', 
    'precio' => 9500, 
    'descripcion' => 'Granos tostados a la perfección.'],
    ['nombre' => 'Alfajor Marroc', 
    'imagen' => 'https://i.pinimg.com/1200x/4e/f0/31/4ef031186eb0275a4f9635b7553031f2.jpg', 
    'precio' => 1200, 
    'descripcion' => 'El favorito de todos.'
    ],
];
?> 

<style>
    #home-hero {
        background-image: url('<?= BASE_URL ?>/img/BonafideHome.png');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        padding-top: 60px;
        position: relative;
    }
    
    #home-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    #home-content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
    }

    #logo-section {
        color: white;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
        text-align: left;
        opacity: 0;
        animation: fadeInSlide 1s ease-out 0.5s forwards;
    }
    #main-logo {
        width: 100%;
        max-width: 850px;
        height: auto;
        margin-bottom: 20px;
        filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.5)); 
        display: block;
        margin-left: -32;
    }
    #logo-section p {
        font-size: 1.5rem;
        font-weight: 300;
        opacity: 0;
        animation: fadeInSlide 1s ease-out 0.8s forwards;
    }

    #carousel-wrapper {
        position: relative; 
        max-width: 400px; 
        margin-left: auto;
    }
    
    .product-card {
        background: rgba(241, 241, 241, 1);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        transform: scale(0.9);
        transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        opacity: 0;
        animation: fadeInScale 0.8s ease-out forwards;
        
        min-height: 550px;
    }
    .product-card:hover {
        transform: scale(1);
        box-shadow: 0 15px 30px rgba(229, 57, 53, 0.5); 
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .card-title {
        color: #e53935;
        font-weight: bold;
    }
    
    #carousel-controls {
        position: absolute;
        bottom: 10px; 
        right: 0;
        z-index: 10;
        display: flex;
        gap: 10px; 
        justify-content: flex-end;
        width: 100%;
    }
    .carousel-control {
        position: relative; 
        display: block;
        width: 40px; 
        height: 40px; 
        opacity: 1; 
        background: rgba(229, 57, 53, 0.9); 
        border-radius: 50%;
        transition: background 0.2s;
    }
    .carousel-control:hover {
        background: #e53935;
    }
    .carousel-control-prev, .carousel-control-next {
        position: relative;
        left: auto;
        right: auto;
    }
    .carousel-control-prev-icon, .carousel-control-next-icon {
        width: 1rem;
        height: 1rem;
    }

    @keyframes fadeInSlide {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes fadeInScale {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; } /* Ajustado a escala 1 para compensar el .9 inicial */
    }

    :root {
    --bs-primary: #dc3545;
    --bs-primary-rgb: 220, 53, 69;

    --bs-danger: #0d6efd;
    --bs-danger-rgb: 13, 110, 253;
    }

</style>

<main>
    <section id="home-hero">
        <div id="home-content">
            
            <div id="logo-section" class="col-md-6 d-none d-md-block">
                <img 
                    src="<?= BASE_URL ?>/img/logo/LogoNombre.png" 
                    alt="Logo Bonafide" 
                    id="main-logo"
                >
                <p>El Café que Sabe a Historia. <br> Descubre nuestros sabores más premium.</p>
                <a href="<?= BASE_URL ?>/pedir" class="btn btn-lg btn-danger mt-4" style="background-color: #e53935; border: none;">
                    Explorar Menú <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>

            <div id="carousel-wrapper" class="col-md-6 col-12">
                
                <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        
                        <?php foreach ($productos_destacados as $index => $producto): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-bs-interval="4000">
                            <div class="product-card p-3">
                                <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                                <div class="card-body p-3">
                                    <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                                    <p class="card-text small text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold text-dark fs-5">$<?= number_format($producto['precio'], 0, ',', '.') ?></span>
                                        <a href="<?= BASE_URL ?>/pedir?producto=<?= $producto['nombre'] ?>" class="btn btn-sm btn-outline-dark">Ver Receta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                    </div>
                    
                    <div id="carousel-controls" class="p-3">
                         <button class="carousel-control carousel-control-prev" type="button" data-bs-target="#product-carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control carousel-control-next" type="button" data-bs-target="#product-carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                    </div>
            </div>

        </div>
    </section>
</main>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>