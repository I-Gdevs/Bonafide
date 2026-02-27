<?php 

if (!defined('BASE_PATH')) define('BASE_PATH', dirname(__DIR__, 2)); 
if (!defined('BASE_URL')) define('BASE_URL', '/');

include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 


$categorias = [
    'combos' => 'Combos', 
    'clasicos' => 'Clásicos', 
    'bebidas_calientes' => 'Bebidas Calientes',
    'cafeteria' => 'Cafetería', 
    'bebidas_frias' => 'Bebidas Frías', 
    'postres' => 'Postres',
];

$productos = [
    [
        'id' => 101, 
        'nombre' => 'COMBO Café + 2 Medialunas', 
        'descripcion' => 'Café con leche con 2 medialunas de manteca.',
        'precio' => 2800, 
        'cat' => 'clasicos', 
        'img' => 'https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg', 
        'combo' => true
    ],
    [
        'id' => 102, 
        'nombre' => 'Submarino', 
        'descripcion' => 'Chocolate caliente con barra fundida.',
        'precio' => 3400, 
        'cat' => 'bebidas_calientes', 
        'img' => 'https://img.freepik.com/premium-photo/closeup-tasty-coffee-espresso-with-tasty-foam-small-ceramic-cup-male-hands-holding-warm-hot-drink_1220-1563.jpg', 
        'combo' => false
    ],
    [
        'id' => 105, 
        'nombre' => 'Cheesecake Frutos Rojos', 
        'descripcion' => 'Porción de torta con base crocante y salsa.',
        'precio' => 5500, 
        'cat' => 'postres', 
        'img' => 'https://img.freepik.com/premium-photo/classic-new-york-cheesecake-with-dollop-whipped-cream_1148901-4889.jpg', 
        'combo' => false
    ],
];
?>

<style>
    
    .product-card { transition: transform 0.2s; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
    
    
    .btn-round-sm {
        width: 32px; height: 32px; 
        padding: 0; 
        display: flex; align-items: center; justify-content: center; 
        font-weight: bold; font-size: 1.2rem; line-height: 1;
    }

    
    .switch-container { background: #eee; border-radius: 50px; position: relative; display: flex; padding: 4px; cursor: pointer; user-select: none; }
    .switch-option { flex: 1; text-align: center; padding: 8px 0; z-index: 2; font-weight: bold; transition: color 0.3s; font-size: 0.85rem; }
    .switch-slider { position: absolute; width: calc(50% - 4px); height: calc(100% - 8px); background: #e53935; border-radius: 50px; transition: transform 0.3s ease; z-index: 1; }
    .switch-container.is-local .switch-slider { transform: translateX(100%); }
    .switch-container.is-local .opt-local { color: white; }
    .switch-container.is-delivery .opt-delivery { color: white; }
    
    .qty-btn { width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; border-radius: 4px; border: 1px solid #e53935; background: white; color: #e53935; cursor: pointer; font-weight: bold; }
    .cart-container { background: white; border-radius: 12px; border: 1px solid #ddd; }
    .cart-header { background: #e53935; color: white; padding: 10px; border-radius: 12px 12px 0 0; text-align: center; }
</style>

<main class="container my-5">
    <div class="row g-4">
        <aside class="col-md-2">
            <h5 class="fw-bold mb-3">CATEGORÍAS</h5>
            <ul class="list-group list-group-flush" id="category-list">
                <li class="list-group-item active" style="cursor:pointer" onclick="filterProducts('todos', this)">Todos</li>
                <?php foreach ($categorias as $key => $name): ?>
                    <li class="list-group-item" style="cursor:pointer" onclick="filterProducts('<?= $key ?>', this)"><?= $name ?></li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="col-md-7">
            <div class="row row-cols-md-3 g-3" id="product-grid">
                
                <?php foreach ($productos as $producto): 
                    // Lógica para filtrar (adaptada al JS nuevo)
                    $filter_categories = $producto['cat'] . ($producto['combo'] ? ' combos' : '');
                ?>
                <div class="col product-item" data-cat="<?= $filter_categories ?>">
                    <div class="card h-100 product-card">
                        <img src="<?= htmlspecialchars($producto['img']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="height: 150px; object-fit: cover;">
                        
                        <div class="card-body">
                            <h6 class="card-title fw-bold"><?= htmlspecialchars($producto['nombre']) ?></h6>
                            <p class="card-text small text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="text-danger fw-bold">$<?= number_format($producto['precio'], 0, ',', '.') ?></span>
                                
                                <button 
                                    class="btn btn-sm btn-outline-danger rounded-circle btn-round-sm"
                                    onclick="addItem(<?= $producto['id'] ?>, '<?= htmlspecialchars($producto['nombre']) ?>', <?= $producto['precio'] ?>)"
                                >
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </section>

        <aside class="col-md-3">
            <div class="cart-container sticky-top" style="top: 20px;">
                <div class="cart-header fw-bold">Mi Pedido</div>
                <div class="p-3">
                    <div id="cart-list" class="mb-3"></div>
                    <hr>
                    <div class="switch-container is-local mb-3" id="delivery-toggle" onclick="toggleDelivery()">
                        <div class="switch-slider"></div>
                        <div class="switch-option opt-delivery">Delivery</div>
                        <div class="switch-option opt-local">Local</div>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span>Envío:</span><span id="ship-cost">$0</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5 mt-2">
                        <span>Total:</span><span id="cart-total">$0</span>
                    </div>
                    <form action="<?= BASE_URL ?>/pagar" method="POST" id="checkout-form">
                        <input type="hidden" name="cart_data" id="cart-input">
                        <input type="hidden" name="delivery_type" id="delivery-input">
                        <button type="button" class="btn btn-danger w-100 mt-3 fw-bold" onclick="goToCheckout()">PAGAR</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</main>

<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    let isDelivery = false;
    const SHIP_FEE = 2100;

    function toggleDelivery() {
        const toggle = document.getElementById('delivery-toggle');
        isDelivery = !isDelivery;
        toggle.classList.toggle('is-local', !isDelivery);
        toggle.classList.toggle('is-delivery', isDelivery);
        renderCart();
    }

    function addItem(id, name, price) {
        if (cart[id]) cart[id].qty++;
        else cart[id] = { id, name, price, qty: 1 };
        renderCart();
    }

    function updateQty(id, change) {
        if (!cart[id]) return;
        cart[id].qty += change;
        if (cart[id].qty <= 0) delete cart[id];
        renderCart();
    }

    function renderCart() {
        const list = document.getElementById('cart-list');
        let subtotal = 0;
        
        const itemsArray = Object.values(cart);
        if (itemsArray.length === 0) {
            list.innerHTML = '<p class="text-center text-muted small">Carrito vacío</p>';
        } else {
            list.innerHTML = '';
            itemsArray.forEach(item => {
                subtotal += item.price * item.qty;
                list.innerHTML += `
                    <div class="d-flex justify-content-between align-items-center mb-3 small border-bottom pb-2">
                        <div style="flex:1">
                            <div class="fw-bold">${item.name}</div>
                            <div class="text-muted">$${item.price.toLocaleString()}</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="qty-btn" onclick="updateQty(${item.id}, -1)">-</button>
                            <span class="fw-bold">${item.qty}</span>
                            <button class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
                        </div>
                    </div>`;
            });
        }

        const ship = isDelivery ? SHIP_FEE : 0;
        document.getElementById('ship-cost').innerText = `$${ship.toLocaleString()}`;
        document.getElementById('cart-total').innerText = `$${(subtotal + ship).toLocaleString()}`;
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function goToCheckout() {
        if (Object.keys(cart).length === 0) return alert("El carrito está vacío.");
        document.getElementById('cart-input').value = JSON.stringify(Object.values(cart));
        document.getElementById('delivery-input').value = isDelivery ? 'delivery' : 'local';
        document.getElementById('checkout-form').submit();
    }

    function filterProducts(cat, el) {
        document.querySelectorAll('.product-item').forEach(i => {
            i.style.display = (cat === 'todos' || i.dataset.cat.includes(cat)) ? 'block' : 'none';
        });
        document.querySelectorAll('#category-list .list-group-item').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', renderCart);
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>