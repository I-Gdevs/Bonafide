<head>
    <title>Bonafide | Pedir</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<?php
$categorias = [
    'combos' => 'Combos', 
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
        'id' => 101, 
        'nombre' => 'COMBO Café con 2 medialunas', 
        'descripcion' => 'Café con 2 medialunas',
        'precio' => 2800, 
        'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg',
        'categoria' => 'clasicos', 
        'es_combo' => true, 
    ],
    [
        'id' => 102, 'nombre' => 'Submarino', 'descripcion' => 'Chocolate caliente',
        'precio' => 3400, 'imagen' => 'https://img.freepik.com/premium-photo/closeup-tasty-coffee-espresso-with-tasty-foam-small-ceramic-cup-male-hands-holding-warm-hot-drink_1220-1563.jpg',
        'categoria' => 'bebidas_calientes', 'es_combo' => false,
    ],
    [
        'id' => 103, 'nombre' => 'COMBO Tostado', 'descripcion' => 'Café + Tostado jamón y queso',
        'precio' => 4800, 'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg',
        'categoria' => 'mediodias', 'es_combo' => true, 
    ],
    [
        'id' => 104, 'nombre' => 'Sandwich Miga', 'descripcion' => 'Jamón y Queso',
        'precio' => 2200, 'imagen' => 'https://img.freepik.com/premium-photo/close-up-bread-table_1048944-27736273.jpg',
        'categoria' => 'sandwiches', 'es_combo' => false,
    ],
    [
        'id' => 105, 'nombre' => 'Torta Cheesecake', 'descripcion' => 'Postre cremoso de frutos rojos',
        'precio' => 5500, 'imagen' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80',
        'categoria' => 'postres', 'es_combo' => false,
    ],
    [
        'id' => 101, 'nombre' => 'Café con Leche Clásico', 'descripcion' => 'Receta base de café con leche.',
        'precio' => 2800, 
        'imagen' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg',
        'categoria' => 'clasicos', 'es_combo' => false,
        'ingredientes' => ['Expresso (50ml)', 'Leche Texturizada (150ml)', 'Azúcar (1 cucharadita)'],
        'pasos' => ['1. Preparar el Expresso.', '2. Texturizar la leche a 65°C.', '3. Verter la leche sobre el Expresso.'],
        'etiquetas' => ['Sin TACC', 'Vegan Friendly'],
    ],
    [
        'id' => 105, 'nombre' => 'Torta Cheesecake New York', 'descripcion' => 'Postre cremoso con base de galleta.',
        'precio' => 5500, 
        'imagen' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg?ga=GA1.1.1758273452.1764627825&semt=ais_hybrid&w=740&q=80',
        'categoria' => 'postres', 'es_combo' => false,
        'ingredientes' => ['Queso Crema (200g)', 'Galletas Graham (150g)', 'Mantequilla (50g)', 'Vainilla'],
        'pasos' => ['1. Triturar galletas y mezclar con mantequilla (base).', '2. Mezclar queso crema, azúcar y vainilla.', '3. Hornear a 160°C por 45 minutos.'],
        'etiquetas' => ['Gluten'],
    ],
    [
        'id' => 103, 'nombre' => 'COMBO Tostado con Café', 'descripcion' => 'Café + Tostado jamón y queso',
        'precio' => 4800, 
        'imagen' => 'https://img.freepik.com/free-photo/closeup-shot-baked-sandwiches-made-with-sausage-served-wooden-board_181624-61300.jpg',
        'categoria' => 'mediodias', 'es_combo' => true,
        'ingredientes' => ['1 Tostado J/Q', '1 Expresso Doble'],
        'pasos' => ['1. Tostar el pan con jamón y queso.', '2. Preparar el café.', '3. Servir inmediatamente.'],
        'etiquetas' => ['Gluten', 'Combo'],
    ],
    [
        'id' => 106, 'nombre' => 'Latte Vainilla Helado', 'descripcion' => 'Bebida fría y refrescante con toque de vainilla.',
        'precio' => 4200, 
        'imagen' => 'https://i.pinimg.com/1200x/4e/f0/31/4ef031186eb0275a4f9635b7553031f2.jpg',
        'categoria' => 'bebidas_frias', 'es_combo' => false,
        'ingredientes' => ['100ml Leche Fría', '50ml Expresso', 'Jarabe de Vainilla', 'Hielo'],
        'pasos' => ['1. Llenar el vaso con hielo.', '2. Verter leche y jarabe.', '3. Añadir el Expresso.', '4. Mezclar suavemente.'],
        'etiquetas' => ['Frío'],
    ],
    [
        'id' => 108, 'nombre' => 'Muffin de Arándanos', 'descripcion' => 'Muffin esponjoso con arándanos frescos.',
        'precio' => 3200, 
        'imagen' => 'https://i.pinimg.com/736x/d3/8d/ec/d38decbae9815ad2855408752ff01b0c.jpg',
        'categoria' => 'postres', 'es_combo' => false,
        'ingredientes' => ['Harina', 'Huevo', 'Azúcar', 'Arándanos'],
        'pasos' => ['1. Preparar la mezcla.', '2. Rellenar moldes.', '3. Hornear a 180°C.'],
        'etiquetas' => ['Gluten'],
    ],
    [
        'id' => 109, 'nombre' => 'Café Americano', 'descripcion' => 'Café expresso diluido con agua caliente.',
        'precio' => 2000, 
        'imagen' => 'https://i.pinimg.com/1200x/c3/2c/ff/c32cff96adfec244037e741ad9bd1c6e.jpg',
        'categoria' => 'cafeteria', 'es_combo' => false,
        'ingredientes' => ['1 Expresso', 'Agua Caliente'],
        'pasos' => ['1. Servir el agua caliente.', '2. Agregar el expresso.'],
        'etiquetas' => ['Sin Lácteos', 'Sin TACC'],
    ],
    [
        'id' => 110, 'nombre' => 'Sándwich de Palta y Huevo', 'descripcion' => 'Tostada con palta y huevo escalfado.',
        'precio' => 4500, 
        'imagen' => 'https://i.pinimg.com/736x/53/ce/49/53ce49c785343c391ea36eb8c76e2864.jpg',
        'categoria' => 'sandwiches', 'es_combo' => false,
        'ingredientes' => ['Pan de masa madre', 'Palta', '1 Huevo', 'Sal y Pimienta'],
        'pasos' => ['1. Tostar el pan.', '2. Untar palta.', '3. Escalfar el huevo y colocar encima.'],
        'etiquetas' => ['Vegetariano'],
    ],
    [
        'id' => 111, 'nombre' => 'Chocolate Caliente Clásico', 'descripcion' => 'El clásico con un toque de canela.',
        'precio' => 3800, 
        'imagen' => 'https://i.pinimg.com/1200x/f2/6d/ce/f26dcee0b1546fbbe86c290889751226.jpg',
        'categoria' => 'bebidas_calientes', 'es_combo' => false,
        'ingredientes' => ['200ml Leche', '30g Chocolate semiamargo', 'Pizca de Canela'],
        'pasos' => ['1. Calentar leche.', '2. Derretir el chocolate.', '3. Mezclar con la canela.'],
        'etiquetas' => ['Lácteo', 'Invierno'],
    ],
];
?>


<main>
    <div class="container my-5">
        <div class="row g-4">
            
            <div class="col-md-2">
                <h4 class="fw-bold mb-3">CATEGORIAS</h4>
                <ul class="list-group" id="category-list">
                    <li class="list-group-item active" data-category="todos" onclick="filterProducts('todos', this)">
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
                    
                    <?php foreach ($productos as $producto): 

                        $filter_categories = $producto['categoria'] . ($producto['es_combo'] ? ' combos' : '');
                    ?>
                    <div class="col product-item" data-categories="<?= $filter_categories ?>">
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
        
            const itemCategories = item.dataset.categories; 
            
            if (categoryKey === 'todos' || itemCategories.includes(categoryKey)) {
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