<?php 
include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 


$promociones = [
    [
        'id' => 1,
        'titulo' => 'Dúo de Mediodía',
        'subtitulo' => 'Café Grande + Medialunas.',
        'precio' => 4500,
        'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg', 
    ],
    [
        'id' => 2,
        'titulo' => 'Especial de la Tarde',
        'subtitulo' => 'Submarino de Chocolate.',
        'precio' => 4900,
        'imagen' => 'https://img.freepik.com/premium-photo/closeup-tasty-coffee-espresso-with-tasty-foam-small-ceramic-cup-male-hands-holding-warm-hot-drink_1220-1563.jpg',
    ],
    [
        'id' => 3,
        'titulo' => 'Pausa Refrescante',
        'subtitulo' => 'Tostados Frescos.',
        'precio' => 3800,
        'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg',
    ],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonafide Digital Signage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* 1. RESET Y PANTALLA COMPLETA */
    body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #f8f8f8;
        font-family: 'Poppins', sans-serif;
    }

    #signage-container {
        width: 100vw;
        height: 100vh;
        position: relative; 
    }

    /* 2. ESTILO BASE DEL SLIDE */
    .promo-slide {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0; 
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 1.5s ease-in-out; 
    }
    
    .promo-slide.active {
        opacity: 1;
    }
    
    /* 3. CONTENEDOR DE CONTENIDO */
    .promo-content {
        width: 100%;
        height: 100%;
        display: flex; 
        align-items: center;
        background-color: white; 
    }
    
    /* Fondo Rojo Oscuro para detalles */
    .promo-details-bg {
        background-color: #A31F1F;
        color: white;
        height: 100%;
    }

    /* 4. ESTILO Y ANIMACIÓN DE TEXTO */
    .promo-details {
        padding: 50px;
        text-align: center;
    }

    .promo-details h1 {
        font-size: 4rem; 
        font-weight: 900;
        color: white; 
    }
    .promo-details h2 {
        font-size: 2.5rem;
        font-weight: 300;
        color: #f0f0f0; 
        margin-top: 15px;
    }
    
    .promo-price-box {
        background-color: #FFC83D; 
        color: #f84b48ff; 
        padding: 15px 35px;
        border-radius: 10px;
        margin-top: 30px;
        display: inline-block;
        font-size: 4rem;
        font-weight: 900;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    /* 5. Estilos de Imagen */
    .image-col {
        background-color: #333;
        height: 100%; 
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .promo-image {
        width: 100%;
        height: 100%;
        object-fit: cover; 
        animation: focus-zoom 10s ease-in-out infinite;
    }
    
    /* 6. ANIMACIONES KEYFRAMES */
    @keyframes slide-in-right {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes pop-up {
        0% { transform: scale(0.5); opacity: 0; }
        70% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); }
    }

    .promo-slide.active h1 { animation: slide-in-right 1s ease-out forwards; }
    .promo-slide.active h2 { animation: slide-in-right 1s ease-out 0.3s forwards; }
    .promo-slide.active .promo-price-box { animation: pop-up 0.6s ease-out 1s forwards; transform: scale(0); }
    .promo-slide.active .promo-image { animation: focus-zoom 10s ease-in-out infinite; }

    @keyframes focus-zoom {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
</style>
<body>

<div id="signage-container">
    
    <?php $i = 0; foreach ($promociones as $promo): $i++; ?>
    <div class="promo-slide" data-id="<?= $i ?>">
        <div class="promo-content">
            <div class="row w-100 h-100 m-0">
                
                <div class="col-6 p-0 image-col">
                    <img src="<?= $promo['imagen'] ?>" alt="<?= $promo['titulo'] ?>" class="promo-image">
                </div>
                
                <div class="col-6 promo-details-bg promo-details d-flex flex-column justify-content-center">
                    <h1 class="display-1"><?= htmlspecialchars($promo['titulo']) ?></h1>
                    <h2 class="mt-3"><?= htmlspecialchars($promo['subtitulo']) ?></h2>
                    
                    <div class="promo-price-box mx-auto">
                        $<?= number_format($promo['precio'], 0, ',', '.') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.promo-slide');
        let currentSlideIndex = 0;
        const totalSlides = slides.length;
        const transitionTime = 8000; 

        function showSlide(index) {
            slides.forEach(slide => {
                slide.classList.remove('active');
            });
            if (slides[index]) {
                slides[index].classList.add('active');
            }
        }

        function nextSlide() {
            currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
            showSlide(currentSlideIndex);
        }
        
        showSlide(currentSlideIndex);
        setInterval(nextSlide, transitionTime);
    });
</script>

</body>
</html>