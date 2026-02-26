<?php 
    if (!defined('BASE_PATH')) define('BASE_PATH', dirname(__DIR__, 2)); 
    if (!defined('BASE_URL')) define('BASE_URL', '/');

    include BASE_PATH . '/views/partials/head.php'; 
    include BASE_PATH . '/views/partials/header.php'; 
    $flash = getFlash();

    $categorias = array_filter(array_unique(array_column($products, "categoria_producto")));
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

<main class="container my-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="fw-bold mb-0 text-dark fs-4">
            <i class="bi bi-shop text-danger me-2"></i>
            Comprando en: <span class="text-danger"><?= htmlspecialchars($_SESSION['nombre_local_preferido'] ?? 'Bonafide') ?></span>
        </h3>
        
        <a href="<?= BASE_URL ?>/choose-shop" class="btn btn-outline-danger btn-sm fw-bold px-3">
            <i class="bi bi-geo-alt-fill me-1"></i> Cambiar sucursal
        </a>
    </div>

    <div class="row g-4">
        <aside class="col-md-2">
            <h5 class="fw-bold mb-3">CATEGORÍAS</h5>
            <ul class="list-group list-group-flush" id="category-list">
                <li class="list-group-item active" style="cursor:pointer" onclick="filterProducts('todos', this)">Todos</li>
                <?php foreach ($categorias as $name): ?>
                    <?php
                        $slug = strtolower(str_replace(" ", "_", $name));
                    ?>
                    <li class="list-group-item" style="cursor:pointer" onclick="filterProducts('<?= $slug ?>', this)">
                        <?= $name ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="col-md-7">
            <div class="row row-cols-md-3 g-3" id="product-grid">
                
                <?php foreach ($products as $producto): 
                    $catSlug = strtolower(str_replace(" ", "_", $producto["categoria_producto"]));

                    $filter_categories = $catSlug . ($producto["es_combo_bool"] ? " combos" : "");
                ?>
                <div class="col product-item" data-cat="<?= $filter_categories ?>">
                    <div class="card h-100 product-card">
                        <img src="img/productos/<?= htmlspecialchars($producto['imagen_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" style="height: 150px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="card-title fw-bold"><?= htmlspecialchars($producto['nombre_producto']) ?></h6>
                                <p class="card-text small text-muted"><?= htmlspecialchars($producto['descripcion_producto']) ?></p>
                            </div>
                            
                            <?php 
                                $stock_disponible = isset($producto['stock_disponible']) ? (int)$producto['stock_disponible'] : 999;
                            ?>

                            <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3">
                                
                                <span class="text-danger fw-bold fs-5">
                                    $<?= number_format($producto['precio_producto'], 0, ',', '.') ?>
                                </span>
                                
                                <?php if ($stock_disponible > 0): ?>
                                    <button 
                                        class="btn btn-sm btn-outline-danger rounded-circle btn-round-sm shadow-sm"
                                        onclick="addItem(<?= $producto['id_producto'] ?>, '<?= htmlspecialchars($producto['nombre_producto'], ENT_QUOTES) ?>', <?= $producto['precio_producto'] ?>, <?= $stock_disponible ?>)"
                                        title="Quedan <?= $stock_disponible ?> disponibles"
                                    >
                                        +
                                    </button>
                                <?php else: ?>
                                    <span class="badge bg-secondary px-2 py-2 shadow-sm">Sin stock</span>
                                <?php endif; ?>
                                
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
                    <form action="<?= BASE_URL ?>/pay" method="POST" id="checkout-form">
                        <input type="hidden" name="cart_data" id="cart-input">
                        <input type="hidden" name="delivery_type" id="delivery-input">
                        <button type="button" class="btn btn-danger w-100 mt-3 fw-bold" onclick="goToCheckout()">PAGAR</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</main>

<!-- FLASH - TOAST ALERTA -->
<?php if ($flash): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="flashToast" class="toast bg-<?= $flash["type"] ?>-subtle" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Avisos | Pedir</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $flash["message"]; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let toastElement = document.getElementById("flashToast");
            var toastTrigger = new bootstrap.Toast(toastElement);
            toastTrigger.show();
        });
    </script>
<?php endif; ?>

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

    function addItem(id, name, price, maxStock) {
        // Se verifica si ya no alcanzó el límite antes de sumar
        if (cart[id] && cart[id].qty >= maxStock) {
            showStockAlert(`No hay más stock disponible para ${name}. Límite: ${maxStock} unidades.`);
            return;
        }

        if (cart[id]) {
            cart[id].qty++;
        } else {
            cart[id] = { id, name, price, qty: 1, maxStock: maxStock }; 
        }
        renderCart();
    }

    function updateQty(id, change) {
        if (!cart[id]) return;

        let newQty = cart[id].qty + change;

        if (change > 0 && newQty > cart[id].maxStock) {
            showStockAlert(`Límite de stock alcanzado (${cart[id].maxStock} unidades máximo).`);
            return;
        }

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

    function showStockAlert(message) {
        let toastContainer = document.getElementById('dynamic-toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'dynamic-toast-container';
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '1055';
            document.body.appendChild(toastContainer);
        }

        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center text-bg-danger border-0 shadow-lg mb-2';
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');

        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        toastContainer.appendChild(toastEl);

        const bsToast = new bootstrap.Toast(toastEl, { delay: 3000 });
        bsToast.show();

        toastEl.addEventListener('hidden.bs.toast', () => {
            toastEl.remove();
        });
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