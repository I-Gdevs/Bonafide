<?php
    // Si una persona entra sin tener una sesión iniciada, se lo redirige a la página de login
    if (!isset($_SESSION['token'])) {
        header("Location: " . BASE_URL . "/login");
    }
?>

<head>
    <title>Bonafide</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<main>
    <div class="container my-5">
        
        <div class="row g-4 align-items-top">
            
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide rounded shadow-sm" data-bs-ride="carousel">
                    
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <div class="carousel-inner carrusel-home">
                        <div class="carousel-item active">
                            <img src="https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg" 
                                 class="d-block img-fluid rounded shadow-sm w-100" alt="Café y medialunas">
                        </div>
                        <div class="carousel-item carrusel-home">
                            <img src="https://i.pinimg.com/736x/d3/8d/ec/d38decbae9815ad2855408752ff01b0c.jpg" 
                                 class="d-block img-fluid rounded shadow-sm w-100" alt="Cafe Premium">
                        </div>
                        <div class="carousel-item carrusel-home">
                            <img src="https://scontent.fsty1-1.fna.fbcdn.net/v/t1.6435-9/46501517_2284071045163079_2038077181564813312_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeHkC1_rSA5O52pFr5jl9MUBjptvEcQxrn6Om28RxDGuftCdU-kcKWJ_fkIe-gV-3YaBiB20SOoMXvJ2kqz2gp-S&_nc_ohc=Tz1RUj0M8ZoQ7kNvwH9ZdGk&_nc_oc=AdmXO2HmqfvgG6JHL4cyNgHh52N73i0NP_BGDHtIgrx9T15pG7XGiS-65upJ39EQM2k&_nc_zt=23&_nc_ht=scontent.fsty1-1.fna&_nc_gid=8EojJKs_JXKzS65zBKTS1g&oh=00_AfhbXLqUWQVa1-C7Wbye1xCZ1b9t9agMNwHcFK_xd3b5Pw&oe=6952CFB6" 
                                 class="d-block img-fluid rounded shadow-sm w-100" alt="Canasta">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card p-4 border-0 shadow">
                    <h2 class="card-title fw-bold text-dark">Café Tostado Premium</h2>
                    
                    <p class="card-text text-muted">
                        Nuestro café más vendido, mezcla especial de granos arábicos tostados a la perfección. 
                        Ideal para empezar el día.
                    </p>

                    <hr>

                    <button class="btn btn-red w-100 py-2 fs-5">
                        Pedir Ahora
                        <i class="bi bi-cart2 ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .carrusel-home, 
    .carrusel-home .carousel-inner,
    .carrusel-home .carousel-item {
        height: 500px; 
        overflow: hidden; 
    }

    .carrusel-home .carousel-item img {
        height: 100%; 
        width: 100%;  
        object-fit: cover; 
    }
</style>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>