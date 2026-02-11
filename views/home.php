<?php 
if (!defined('BASE_PATH')) define('BASE_PATH', dirname(__DIR__, 2)); 
if (!defined('BASE_URL')) define('BASE_URL', '/');

include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 
?>

<style>
    body { font-family: 'Poppins', sans-serif; color: #333; }
    
    .text-bonafide { color: #e53935; }
    .bg-bonafide { background-color: #e53935; color: white; }
    
    .hero-section {
        position: relative;
        height: 55vh; 
        background-image: url('<?= BASE_URL ?>/img/BonafideHome.png');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }
    
    .hero-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5); 
        z-index: 1;
    }
    
    .hero-content { position: relative; z-index: 2; max-width: 800px; padding: 20px; }
    
    .hero-title {
        font-size: 3.5rem; font-weight: 800; margin-bottom: 20px;
        text-shadow: 0 4px 10px rgba(0,0,0,0.3);
        letter-spacing: -1px;
    }
    
    .hero-subtitle { font-size: 1.2rem; margin-bottom: 40px; font-weight: 300; opacity: 0.9; }

    /* --- BOTONES MODERNOS --- */
    .btn-cta {
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: bold;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .btn-cta-primary {
        background-color: #e53935; color: white; border: none;
    }
    .btn-cta-primary:hover {
        background-color: #c62828; transform: translateY(-3px); color: white;
        box-shadow: 0 15px 30px rgba(229, 57, 53, 0.4);
    }

    .btn-cta-outline {
        background: transparent; border: 2px solid white; color: white; margin-left: 10px;
    }
    .btn-cta-outline:hover {
        background: white; color: #333; transform: translateY(-3px);
    }

    /* --- SECCIÓN DE BENEFICIOS --- */
    .features-section { padding: 80px 0; background: #fff; }
    .feature-card {
        text-align: center; padding: 30px; border-radius: 15px;
        transition: transform 0.3s;
    }
    .feature-card:hover { transform: translateY(-10px); }
    .feature-icon {
        width: 80px; height: 80px; margin: 0 auto 20px;
        background: #ffebee; color: #e53935;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
    }

    /* --- FAVORITOS (Productos Destacados) --- */
    .favorites-section { padding: 80px 0; background: #f9f9f9; }
    .fav-card {
        border: none; border-radius: 15px; overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s;
        background: white;
    }
    .fav-card:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.1); transform: translateY(-5px); }
    .fav-img { height: 200px; object-fit: cover; }

    /* --- PROMO BANNER --- */
    .promo-banner {
        background: #e53935; color: white; padding: 60px 0; text-align: center;
        background-image: linear-gradient(45deg, #c62828 25%, #e53935 25%, #e53935 50%, #c62828 50%, #c62828 75%, #e53935 75%, #e53935 100%);
        background-size: 20px 20px;
    }

    /* ANIMACIONES */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.3s; }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .btn-cta { width: 100%; display: block; margin: 10px 0 0 0; }
    }

    :root {
    --bs-primary: #dc3545;
    --bs-primary-rgb: 220, 53, 69;

    --bs-danger: #0d6efd;
    --bs-danger-rgb: 13, 110, 253;
    }

</style>

<main>
    
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            
            <h1 class="hero-title animate-up delay-1">El sabor de siempre,<br>ahora donde estés.</h1>
            <p class="hero-subtitle animate-up delay-2">Disfruta de tu café Bonafide favorito y nuestra pastelería artesanal sin hacer filas. Pide online y retira o recibe en casa.</p>
            <div class="animate-up delay-2">
                <a href="<?= BASE_URL ?>/pedir" class="btn btn-cta btn-cta-primary text-decoration-none">
                    <i class="bi bi-bag-check-fill me-2"></i> Hacer Pedido
                </a>
                <a href="#favoritos" class="btn btn-cta btn-cta-outline text-decoration-none">Ver Menú</a>
            </div>
        </div>
    </section>

    

    <section id="favoritos" class="favorites-section">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-danger fw-bold text-uppercase ls-2">Nuestros Clásicos</h6>
                <h2 class="fw-bold">Los favoritos de la semana</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card fav-card h-100">
                        <img src="https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg" class="card-img-top fav-img" alt="Café">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold">Combo Desayuno</h5>
                            <p class="text-muted small">Café con leche + 2 Medialunas de manteca.</p>
                            <h5 class="text-danger fw-bold">$2.800</h5>
                            <a href="<?= BASE_URL ?>/pedir" class="btn btn-outline-danger rounded-pill w-100 mt-2 fw-bold">Pedir Ahora</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card fav-card h-100">
                        <img src="https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg" class="card-img-top fav-img" alt="Torta">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold">Cheesecake NY</h5>
                            <p class="text-muted small">La dulzura perfecta con frutos rojos frescos.</p>
                            <h5 class="text-danger fw-bold">$5.500</h5>
                            <a href="<?= BASE_URL ?>/pedir" class="btn btn-outline-danger rounded-pill w-100 mt-2 fw-bold">Pedir Ahora</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card fav-card h-100">
                        <img src="https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg" class="card-img-top fav-img" alt="Tostado">
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold">Tostado Especial</h5>
                            <p class="text-muted small">Jamón y queso en pan de miga tostado.</p>
                            <h5 class="text-danger fw-bold">$4.800</h5>
                            <a href="<?= BASE_URL ?>/pedir" class="btn btn-outline-danger rounded-pill w-100 mt-2 fw-bold">Pedir Ahora</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?= BASE_URL ?>/pedir" class="btn btn-link text-danger fw-bold text-decoration-none fs-5">
                    Ver todo el menú <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>


</main>

<script>
    // Pequeño script para suavizar el scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>