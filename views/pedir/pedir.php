<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>
<head>
    <title>Pedir</title>
</head>



<main>
    <div class="container my-5">
        
        <div class="row g-4">
            
            <div class="col-md-2">
                <h4 class="fw-bold mb-3">CATEGORIAS</h4>
                <ul class="list-group">
                    <li class="list-group-item active">
                        <a href="#" class="text-decoration-none">Clásicos</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Bebidas Calientes</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Cafetería</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Bebidas Frías</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Postres</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Mediodías</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark">Sandwiches</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-7">
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    
                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg" class="card-img-top" alt="Combo" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">COMBO</h6>
                                <p class="card-text small text-muted">Café con 2 medialunas</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-danger fw-bold">$2800</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="https://img.freepik.com/premium-photo/closeup-tasty-coffee-espresso-with-tasty-foam-small-ceramic-cup-male-hands-holding-warm-hot-drink_1220-1563.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80" class="card-img-top" alt="Submarino" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">Submarino</h6>
                                <p class="card-text small text-muted">Chocolate caliente</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-danger fw-bold">$3400</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80" class="card-img-top" alt="Tostado" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">COMBO Tostado</h6>
                                <p class="card-text small text-muted">Café + Tostado jamón y queso</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-danger fw-bold">$4800</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col">
                        <div class="card h-100 product-card">
                            <img src="https://img.freepik.com/premium-photo/close-up-bread-table_1048944-27736273.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80" class="card-img-top" alt="Sandwich" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">Sandwich Miga</h6>
                                <p class="card-text small text-muted">Jamón y Queso</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-danger fw-bold">$2200</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
            </div>

            <div class="col-md-3">
                <div class="cart-container shadow-sm sticky-top" style="top: 20px; z-index: 100;">
                    
                    <div class="cart-header d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-basket me-2" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        Pedido
                    </div>

                    <div class="p-3 bg-light">
                        
                        <div class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-2">
                            <div class="d-flex align-items-center">
                                <div class="me-2 d-flex flex-column align-items-center">
                                    <small class="fw-bold text-muted">-</small>
                                    <span class="fw-bold">1x</span>
                                    <small class="fw-bold text-muted">+</small>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">$2100</div>
                                    <small class="text-dark fw-bold">Café Negro simple</small><br>
                                    <small class="text-muted" style="font-size: 0.8rem;">Expresso Simple</small>
                                </div>
                            </div>
                            <button class="btn btn-sm text-danger p-0 border-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/></svg>
                            </button>
                        </div>

                        <div class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-2">
                             <div class="d-flex align-items-center">
                                <div class="me-2 d-flex flex-column align-items-center">
                                    <small class="fw-bold text-muted">-</small>
                                    <span class="fw-bold">2x</span>
                                    <small class="fw-bold text-muted">+</small>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">$400</div>
                                    <small class="text-dark fw-bold">Medialunas</small><br>
                                    <small class="text-muted" style="font-size: 0.8rem;">Saladas</small>
                                </div>
                            </div>
                            <button class="btn btn-sm text-danger p-0 border-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/></svg>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold">Subtotal</span>
                                <span>$6300</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Costo de envío</span>
                                <span>$2100</span>
                            </div>
                            
                            <div class="bg-white p-2 rounded text-center mb-3 shadow-sm">
                                <span class="fw-bold text-dark">Total a pagar</span>
                                <h3 class="fw-bold text-dark mb-0">$8400</h3>
                            </div>

                            <div class="d-flex justify-content-around mb-3 text-center small text-muted">
                                <div class="bg-white p-2 rounded border w-50 me-1">
                                    <i class="bi bi-scooter"></i> Delivery<br>09:00 a 13:00
                                </div>
                                <div class="bg-white p-2 rounded border w-50 ms-1">
                                    <i class="bi bi-shop"></i> Local<br>08:00 a 19:00
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-pagar w-100 py-2">Pagar</button>

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>