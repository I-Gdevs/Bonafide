<head>
    <title>Nosotros</title>
</head>

<?php 
include __DIR__ . '/../partials/head.php'; 
include __DIR__ . '/../partials/header.php'; 
?>

<style>
    /* Asegurar ancho fijo de 1320px */
    .fixed-width-container {
        max-width: 1320px !important;
    }
    .history-quote {
        font-style: italic;
        border-left: 3px solid #e53935;
        padding-left: 15px;
    }
    .text-italic{
        font-style: italic;
        padding-left: 15px;
    }
    .location-header {
        font-weight: 700;
        color: #e53935;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 5px;
        margin-bottom: 1.5rem;
    }
    .location-info .icon {
        color: #e53935;
        margin-right: 8px;
    }
</style>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <h1 class="fw-bold mb-4">Sobre Bonafide</h1>
        
        <div class="row mb-5">
            <div class="col-md-7">
                <h3 class="fw-bold text-dark mb-3">Nuestra Trayectoria</h3>
                <blockquote class="history-quote text-muted">
                    Bonafide comienza en 1917, cuando Geraldo Trinks, hijo de importadores de café, decidió abrir un kiosco en el Pasaje Güemes, en pleno centro porteño. Allí se dedicó a la venta de café y se instaló la primera máquina tostadora del país. Aquel café nuevo, entero, sin baño de azúcar y accesible a todos los bolsillos se abrió camino, y tal fue el éxito del emprendimiento que para poder recibir a la gran cantidad de clientes Trinks abrió un segundo local en la misma galería, al que sumó la venta de caramelos. Geraldo sintió la necesidad de darle un nombre a su marca, que fuera reflejo de tradición y confianza. Así surgió Bonafide (buena fe), que ha sido desde entonces símbolo y bandera de la empresa.
                </blockquote>
                <p class="text-italic text-dark mb-3">
                    Desde entonces, Bonafide ha evolucionado, pero mantiene el espíritu emprendedor y la pasión por los sabores. El café se convirtió en un símbolo de tradición y calidad, valores que se reflejan en cada uno de nuestros productos, desde el clásico Tostado hasta las variedades gourmet.
                </p>
                <p class="text-italic text-dark mb-3">
                    Somos una marca con más de 100 años de historia, reflejo de tradición y confianza.
                </p>
                <p class="fw-bold text-italic text-dark mb-3">
                    Vision
                </p>
                <p class="text-italic text-dark mb-3">
                    Ser reconocidos por la calidad de nuestro café y chocolates, en un lugar donde se viven gratos momentos.
                </p>
            </div>
            <div class="col-md-5">
                <img src="<?= BASE_URL ?>/img/nosotros/historiaCamionesBonafide.jpg" alt="Antigua imagen de Bonafide" class="img-fluid rounded shadow">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="fw-bold text-dark mb-4">Nuestros Locales</h3>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card p-3 shadow-sm">
                    <h4 class="location-header">Bonafide Tribunales</h4>
                    <div class="location-info mb-3">
                        <p class="mb-1"><i class="bi bi-geo-alt-fill icon"></i> Mitre 140, Concordia, Entre Ríos</p>
                        <p class="mb-1"><i class="bi bi-telephone-fill icon"></i> +54 0345 421-1447</p>
                    </div>
                    <div class="ratio ratio-4x3 rounded overflow-hidden">
                         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d152.01633519808627!2d-58.01684497576852!3d-31.391696291689233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95e26b1f24d7768f%3A0x6b8d234567890abc!2sMitre%20140%2C%20E3200AJE%20Concordia%2C%20Entre%20R%C3%ADos!5e0!3m2!1sen!2sar!4v1701625902000!5m2!1sen!2sar" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card p-3 shadow-sm">
                    <h4 class="location-header">Bonafide Peatonal</h4>
                    <div class="location-info mb-3">
                        <p class="mb-1"><i class="bi bi-geo-alt-fill icon"></i> Mitre 37, Concordia, Entre Ríos</p>
                        <p class="mb-1"><i class="bi bi-telephone-fill icon"></i> +54 0345 429-2324</p>
                    </div>
                     <div class="ratio ratio-4x3 rounded overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3408.822851893817!2d-58.01955682500057!3d-31.391696291689233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95e26b1f24d7768f%3A0x6b8d234567890abc!2sMitre%2037%2C%20E3200AJE%20Concordia%2C%20Entre%20R%C3%ADos!5e0!3m2!1sen!2sar!4v1701625902000!5m2!1sen!2sar" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>