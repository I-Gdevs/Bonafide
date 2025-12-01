<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/header.php'; ?>

<head>
    <title>Bonafide</title>
</head>

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
                                 class="d-block w-100" alt="Café y medialunas">
                        </div>
                        <div class="carousel-item carrusel-home">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_918944-MLA83901995898_042025-O.webp" 
                                 class="d-block w-100" alt="Cafe Premium">
                        </div>
                        <div class="carousel-item carrusel-home">
                            <img src="https://scontent.fsty1-1.fna.fbcdn.net/v/t1.6435-9/46501517_2284071045163079_2038077181564813312_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeHkC1_rSA5O52pFr5jl9MUBjptvEcQxrn6Om28RxDGuftCdU-kcKWJ_fkIe-gV-3YaBiB20SOoMXvJ2kqz2gp-S&_nc_ohc=Tz1RUj0M8ZoQ7kNvwH9ZdGk&_nc_oc=AdmXO2HmqfvgG6JHL4cyNgHh52N73i0NP_BGDHtIgrx9T15pG7XGiS-65upJ39EQM2k&_nc_zt=23&_nc_ht=scontent.fsty1-1.fna&_nc_gid=8EojJKs_JXKzS65zBKTS1g&oh=00_AfhbXLqUWQVa1-C7Wbye1xCZ1b9t9agMNwHcFK_xd3b5Pw&oe=6952CFB6" 
                                 class="d-block w-100" alt="Canasta">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-fill ms-2" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5.485 14.5a1 1 0 1 0-2 0 1 1 0 0 0 2 0m7 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0"/>
                        </svg>
                    </button>

                </div>

                    <div class="text-center">
                        <p class="mt-5">Inicia sesión para pedir
                            <a href="login.php" class="btn btn-red btn-sm ms-2">Iniciar sesión</a>
                        </p>

                        

                        <p class="mt-2">¿No estás registrado?
                            <a href="register.php" class="btn btn-red btn-sm ms-2">Registrarse</a>
                        </p>
                    </div>
            </div>
        </div>
    </div>
</main>

<style>
    .carrusel-home, 
    .carrusel-home .carousel-inner,
    .carrusel-home .carousel-item {
        height: 500px; /* ALTURA MÁXIMA DESEADA */
        overflow: hidden; 
    }

    .carrusel-home .carousel-item img {
        height: 100%; 
        width: 100%;  
        object-fit: cover; 
    }
</style>



  <?php include __DIR__ . '/partials/footer.php'; ?>