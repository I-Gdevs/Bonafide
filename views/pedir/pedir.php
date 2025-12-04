<head>
    <title>Bonafide | Pedir</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<?php

$categorias = [
    'clasicos' => 'Clásicos',
    'bebidas_calientes' => 'Bebidas Calientes',
    'cafeteria' => 'Cafetería',
    'bebidas_frias' => 'Bebidas Frías',
    'postres' => 'Postres',
    'mediodias' => 'Mediodías',
    'sandwiches' => 'Sandwiches',
];


$productos = [
    [
        'id' => 101, 'nombre' => 'COMBO Café con 2 medialunas', 'descripcion' => 'Café con 2 medialunas',
        'precio' => 2800, 'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg',
        'categoria' => 'clasicos'
    ],
    [
        'id' => 102, 'nombre' => 'Submarino', 'descripcion' => 'Taza de chocolate caliente con crema',
        'precio' => 3400, 'imagen' => 'https://img.freepik.com/premium-photo/una-taza-de-chocolate-calientito-colombiano-con_948265-279876.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80',
        'categoria' => 'bebidas_calientes'
    ],
    [
        'id' => 103, 'nombre' => 'COMBO Tostado', 'descripcion' => 'Café + Tostado jamón y queso',
        'precio' => 4800, 'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg',
        'categoria' => 'mediodias'
    ],
    [
        'id' => 104, 'nombre' => 'Sandwich Miga', 'descripcion' => 'Jamón y Queso',
        'precio' => 2200, 'imagen' => 'https://img.freepik.com/premium-photo/close-up-bread-table_1048944-27736273.jpg',
        'categoria' => 'sandwiches'
    ],
    [
        'id' => 105, 'nombre' => 'Torta Cheesecake', 'descripcion' => 'Postre cremoso de frutos rojos',
        'precio' => 5500, 'imagen' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80',
        'categoria' => 'postres'
    ],
];
?>

<main>
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-2">
                <h4 class="fw-bold mb-3">CATEGORIAS</h4>
                <ul class="list-group" id="category-list">
                    <li class="list-group-item active" data-category="todos" onclick="filterProducts('todos')">
                        <a href="#" class="text-decoration-none">Todos</a>
                    </li>
                    
                    <?php foreach ($categorias as $key => $name): ?>
                    <li class="list-group-item" data-category="<?= $key ?>" onclick="filterProducts('<?= $key ?>', this)">
                        <a href="#" class="text-decoration-none text-dark"><?= htmlspecialchars($name) ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="col-md-7">
                <div class="row row-cols-1 row-cols-md-3 g-3" id="product-grid">
                    
                    <?php foreach ($productos as $producto): ?>
                    <div class="col product-item" data-category="<?= $producto['categoria'] ?>">
                        <div class="card h-100 product-card">
                            <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title fw-bold"><?= htmlspecialchars($producto['nombre']) ?></h6>
                                <p class="card-text small text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-danger fw-bold">$<?= number_format($producto['precio'], 0, ',', '.') ?></span>
                                    <button 
                                        class="btn btn-sm btn-outline-danger rounded-circle btn-round-sm"
                                        onclick="window.addItem('<?= $producto['id'] ?>', '<?= htmlspecialchars($producto['nombre']) ?>', '<?= $producto['precio'] ?>')"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="cart-container shadow-sm sticky-top" style="top: 20px; z-index: 100;">
                    
                    <div class="cart-header d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-basket me-2" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/></svg>
                        Pedido
                    </div>

                    <div class="p-3 bg-light">
                        <div class="mb-4" id="cart-items-list">
                            </div>
                        
                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold">Subtotal</span>
                                <span id="cart-subtotal">$0</span> 
                            </div>
                            <div class="d-flex justify-content-between mb-3" id="shipping-line">
                                <span class="fw-bold">Costo de envío</span>
                                <span id="shipping-cost">$0</span> 
                            </div>
                            
                            <div class="bg-white p-2 rounded text-center mb-3 shadow-sm">
                                <span class="fw-bold text-dark">Total a pagar</span>
                                <h3 class="fw-bold text-dark mb-0" id="total-a-pagar">$0</h3> 
                            </div>

                            <div class="d-flex justify-content-around mb-3 text-center small text-muted" id="delivery-options-container">
                                <div id="delivery-option" class="bg-white p-2 rounded border w-50 me-1 delivery-option" onclick="window.setDeliveryType('delivery')">
                                    <i class="bi bi-scooter"></i> Delivery<br>09:00 a 13:00
                                </div>
                                <div id="local-option" class="bg-white p-2 rounded border w-50 ms-1 delivery-option active-delivery" onclick="window.setDeliveryType('local')">
                                    <i class="bi bi-shop"></i> Local<br>08:00 a 19:00
                                </div>
                            </div>

                            <a href="<?= BASE_URL ?>/pagar" class="btn btn-pagar w-100 py-2 text-decoration-none">
                                Pagar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    window.cart = JSON.parse(localStorage.getItem('bonafideCart')) || {};
    window.deliveryType = localStorage.getItem('bonafideDeliveryType') || 'local';
    const fixedShippingCost = 2100;
    const cartItemsContainer = document.getElementById('cart-items-list');
    const subtotalElement = document.getElementById('cart-subtotal');
    const totalElement = document.getElementById('cart-total');
    const totalPagarElement = document.getElementById('total-a-pagar');
    const shippingCostElement = document.getElementById('shipping-cost');
    const deliveryOption = document.getElementById('delivery-option');
    const localOption = document.getElementById('local-option');
    const productGrid = document.getElementById('product-grid');

    function formatCurrency(amount) {
        return '$' + amount.toLocaleString('es-AR', { minimumFractionDigits: 0 }); 
    }
    
    function calculateShippingCost() {
        return (window.deliveryType === 'delivery') ? fixedShippingCost : 0;
    }

    window.renderCart = function() {
        cartItemsContainer.innerHTML = ''; 
        let subtotal = 0;
        const currentShippingCost = calculateShippingCost();
        
        if (Object.keys(window.cart).length === 0) {
             cartItemsContainer.innerHTML = '<p class="text-muted small text-center">El carrito está vacío.</p>';
        } else {
            for (const id in window.cart) {
                const item = window.cart[id];
                subtotal += item.quantity * item.price;
                
                const itemHtml = `
                    <div class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-2" data-cart-id="${id}">
                        <div class="d-flex align-items-center">
                            <div class="me-2 d-flex flex-column align-items-center">
                                <button class="btn btn-outline-danger btn-round-sm-cart" onclick="window.updateQuantity('${id}', -1)">-</button>
                                <span class="fw-bold">${item.quantity}x</span>
                                <button class="btn btn-outline-danger btn-round-sm-cart" onclick="window.updateQuantity('${id}', 1)">+</button>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">${formatCurrency(item.quantity * item.price)}</div>
                                <small class="text-dark fw-bold">${item.name}</small>
                            </div>
                        </div>
                        <button class="btn btn-sm text-danger p-0 border-0" onclick="window.removeItem('${id}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/></svg>
                        </button>
                    </div>
                `;
                cartItemsContainer.innerHTML += itemHtml;
            }
        }

        const totalFinal = subtotal + currentShippingCost;
        
        subtotalElement.textContent = formatCurrency(subtotal);
        shippingCostElement.textContent = formatCurrency(currentShippingCost); 
        totalElement.textContent = formatCurrency(totalFinal);
        
        totalPagarElement.textContent = formatCurrency(totalFinal); 
        
        deliveryOption.classList.toggle('active-delivery', window.deliveryType === 'delivery');
        localOption.classList.toggle('active-delivery', window.deliveryType === 'local');

        localStorage.setItem('bonafideCart', JSON.stringify(window.cart));
        localStorage.setItem('bonafideDeliveryType', window.deliveryType);
    }
    
    window.setDeliveryType = function(type) {
        window.deliveryType = type;
        window.renderCart();
    }
    
    window.addItem = function(id, name, price) {
        if (window.cart[id]) {
            window.cart[id].quantity += 1;
        } else {
            window.cart[id] = { id, name, price: parseInt(price), quantity: 1 };
        }
        window.renderCart();
    }
    
    window.removeItem = function(id) {
        delete window.cart[id];
        window.renderCart();
    }

    window.updateQuantity = function(id, change) {
        window.cart[id].quantity += change;
        if (window.cart[id].quantity <= 0) {
            window.removeItem(id);
        } else {
            window.renderCart();
        }
    }

    
    window.filterProducts = function(categoryKey, clickedElement) {
        const productItems = document.querySelectorAll('.product-item');
        const categoryItems = document.querySelectorAll('#category-list li');
        
        productItems.forEach(item => {
            const itemCategory = item.dataset.category;
            
            if (categoryKey === 'todos' || itemCategory === categoryKey) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        categoryItems.forEach(item => {
            item.classList.remove('active');
        });

        if (clickedElement) {
             clickedElement.classList.add('active');
        } else if (categoryKey === 'todos') {
            
            document.querySelector('#category-list li[data-category="todos"]').classList.add('active');
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        window.renderCart();
        window.filterProducts('todos'); 
    });

</script>


<?php include BASE_PATH . '/views/partials/footer.php'; ?>