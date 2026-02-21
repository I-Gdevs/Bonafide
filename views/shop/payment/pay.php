<?php
    include BASE_PATH . '/views/partials/head.php'; 
    include BASE_PATH . '/views/partials/header.php'; 

    $cart_json = $_POST['cart_data'] ?? $_SESSION['temp_cart'] ?? '[]';
    
    if (isset($_SESSION['temp_cart'])) {
        unset($_SESSION['temp_cart']);
    }

    $show_success_popup = false;
    $last_sale_id = null;

    if (isset($_SESSION['sale_success'])) {
        $show_success_popup = true;
        $last_sale_id = $_SESSION['last_sale_id'] ?? null;
        unset($_SESSION['sale_success']);
    }

    if (!$show_success_popup && (empty($cart_json) || $cart_json === '[]')) {
        header("Location: " . BASE_URL . "/shop");
        exit;
    }

    $productos_checkout = json_decode($cart_json, true);
    $tipo_entrega = $_POST['delivery_type'] ?? 'local';
    $sucursal_id = $_SESSION['id_local_preferido'] ?? null;

    $nombre_local = "Bonafide";
    $direccion_local = "Dirección a confirmar";

    if ($sucursal_id && !empty($buildings)) {
        foreach ($buildings as $local) {
            $id_actual = $local['id_local'] ?? $local['id']; 
            
            if ($id_actual == $sucursal_id) {
                $nombre_local = $local['nombre_local'] ?? $local['nombre'];
                $direccion_local = $local['direccion_local'] ?? $local['direccion'];
                break;
            }
        }
    }

    $costo_envio = ($tipo_entrega === 'delivery') ? 2100 : 0;
    $subtotal = 0;

    $nombre_user = $_SESSION["user"]["user_fullname"] ?? "";
    $dni_user = $_SESSION["user"]["user_dni"] ?? "";
    $correo_user = $_SESSION["user"]['user_email'] ?? "";

    $celular_user= "";

    $flash = getFlash();
?>

<style>
    .checkout-container {
        background: white;
        border-radius: 12px; 
        border: 1px solid #ddd; 
        padding: 25px; 
    }
    .order-summary { 
        background: #f9f9f9; 
        border-radius: 12px; 
        border: 1px solid #eee; 
        padding: 20px; 
    }
    .local-info-box { 
        border-left: 4px solid #e53935; 
        background: #fff; 
        padding: 10px; 
        margin-bottom: 15px; 
    }
    #success-popup { 
        display: none; 
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background: rgba(0,0,0,0.8); 
        z-index: 9999; 
        align-items: center; 
        justify-content: center; 
    }
</style>

<main class="container my-5">
    <div class="mb-4">
        <a href="<?= BASE_URL ?>/shop" class="btn btn-link text-danger fw-bold p-0 text-decoration-none">
            <i class="bi bi-arrow-left"></i> VOLVER A MI PEDIDO
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="checkout-container shadow-sm">
                <h4 class="fw-bold mb-4 border-bottom pb-2">Datos de Facturación</h4>
                <form id="main-payment-form" action="<?= BASE_URL ?>/pay/create" method="POST">
                    <input type="hidden" name="cart_data" value="<?= htmlspecialchars($cart_json, ENT_QUOTES, "UTF-8") ?>">
                    <input type="hidden" name="delivery_type" value="<?= htmlspecialchars($tipo_entrega) ?>">
                    <input type="hidden" name="sucursal" value="<?= htmlspecialchars($sucursal_id) ?>">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="fw-bold small">Nombre completo</label>
                            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre_user) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small">DNI</label>
                            <input type="text" name="dni" class="form-control" value="<?= htmlspecialchars($dni_user) ?>" required>
                        </div>
                        
                        
                        <?php if ($tipo_entrega === 'delivery'): ?>
                        <div class="row g-2 justify-content-between">
                            <div class="col-md-6">
                                <label class="fw-bold small">Calle</label>
                                <input type="text" name="calle" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fw-bold small">Número</label>
                                <input type="text" name="numero" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fw-bold small">Piso/Departamento</label>
                                <input type="text" name="dpto" class="form-control" placeholder="(opcional)">
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row g-2">
                            <div class="col-md-6 g-2">
                                <label class="fw-bold small">Número de celular / WhatsApp</label>
                                <input type="text" name="celular" class="form-control" required>
                            </div>
                            <div class="col-md-6 g-2">
                                <label class="fw-bold small">Correo electrónico</label>
                                <input type="text" name="correo" class="form-control" value="<?= htmlspecialchars($correo_user) ?>" required>
                            </div>
                        </div>

                        <div class="col-12 mt-4 border-top pt-3">
                            <h6 class="fw-bold mb-3">Método de Pago</h6>
                            <div class="d-flex gap-4 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="pago_tarjeta" value="Tarjeta" checked onchange="togglePaymentMethod()">
                                    <label class="form-check-label" for="pago_tarjeta">
                                        <i class="bi bi-credit-card me-1 text-danger"></i> Tarjeta Online
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="pago_efectivo" value="Efectivo" onchange="togglePaymentMethod()">
                                    <label class="form-check-label" for="pago_efectivo">
                                        <i class="bi bi-cash me-1 text-success"></i> Efectivo (al recibir)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12" id="card-details-section">
                            <div class="p-3 border rounded bg-light">
                                <input type="text" class="form-control mb-2 card-input" placeholder="0000 0000 0000 0000" required>
                                <div class="row">
                                    <div class="col-6"><input type="text" class="form-control card-input" placeholder="MM/AA" required></div>
                                    <div class="col-6"><input type="text" class="form-control card-input" placeholder="CVC" required></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <aside class="col-md-5">
            <div class="order-summary shadow-sm">
                <h5 class="fw-bold mb-3">Resumen del Pedido</h5>

                <div class="local-info-box shadow-sm">
                    <div class="fw-bold text-danger">
                        <i class="bi bi-shop"></i>
                        <?= ($tipo_entrega === "local") ? "Retiro en:" : "Se envía desde:"; ?>
                    </div>
                    <div class="fw-bold">Sucursal <?= htmlspecialchars($nombre_local) ?></div>
                    <div class="text-muted small">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                        <?= htmlspecialchars($direccion_local) ?>
                    </div>
                </div>

                <div class="product-list mb-4">
                    <?php if (empty($productos_checkout)): ?>
                        <p class="text-muted">No hay productos en el pedido.</p>
                    <?php else: ?>
                        <?php foreach ($productos_checkout as $item): 
                            $total_item = $item['price'] * $item['qty'];
                            $subtotal += $total_item;
                        ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><strong><?= $item['qty'] ?>x</strong> <?= htmlspecialchars($item['name']) ?></span>
                            <span>$<?= number_format($total_item, 0, ',', '.') ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Subtotal:</span>
                        <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Envío:</span>
                        <span>$<?= number_format($costo_envio, 0, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-4 mt-2 border-top pt-2">
                        <span>Total:</span>
                        <span>$<?= number_format($subtotal + $costo_envio, 0, ',', '.') ?></span>
                    </div>
                </div>

                <button class="btn btn-danger w-100 mt-4 py-3 fw-bold" onclick="showFinalPopup()">
                    CONFIRMAR PAGO
                </button>
            </div>
        </aside>
    </div>
</main>

<div id="success-popup">
    <div class="bg-white p-5 rounded-4 text-center shadow-lg" style="max-width: 400px;">
        <div class="text-success mb-3" style="font-size: 4rem;"><i class="bi bi-check-circle-fill"></i></div>
        <h2 class="fw-bold">¡Hecho!</h2>
        <p class="text-muted">Tu pedido ha sido realizado con éxito.</p>
        
        <button class="btn btn-danger w-100 mb-2" onclick="clearAndGo()">Cerrar y Volver</button>
        
        <button class="btn btn-outline-danger w-100 fw-bold" onclick="printTicket('<?= $last_sale_id ?>')">
            <i class="bi bi-file-earmark-pdf-fill me-1"></i>
            Imprimir Ticket
        </button>
    </div>
</div>

<!-- FLASH - TOAST ALERTA -->
<?php if ($flash): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="flashToast" class="toast bg-<?= $flash["type"] ?>-subtle" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Avisos | Pagos</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $flash["message"]; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if ($flash): ?>
            let toastElement = document.getElementById("flashToast");
            let toastTrigger = new bootstrap.Toast(toastElement);
            toastTrigger.show();
        <?php endif; ?>
        
        <?php if ($show_success_popup): ?>
            localStorage.removeItem('cart');
            document.getElementById('success-popup').style.display = 'flex';
        <?php endif; ?>
    });


    function togglePaymentMethod() {
        const isCard = document.getElementById('pago_tarjeta').checked;
        const cardSection = document.getElementById('card-details-section');
        const cardInputs = document.querySelectorAll('.card-input');

        if (isCard) {
            cardSection.style.display = 'block';
            cardInputs.forEach(input => input.setAttribute('required', 'required'));
        } else {
            cardSection.style.display = 'none';
            cardInputs.forEach(input => input.removeAttribute('required'));
        }
    }

    function showFinalPopup() {
        const form = document.getElementById('main-payment-form');
        
        if(form.checkValidity()) {
            const btn = document.querySelector('button[onclick="showFinalPopup()"]');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Procesando...';
            btn.disabled = true;

            form.submit();
        } else {
            form.reportValidity();
        }
    }

    function clearAndGo() {
        window.location.href = '<?= BASE_URL ?>/shop';
    }

    function printTicket(idVenta) {
        if (!idVenta) {
            alert("No se encontró el número de comprobante para imprimir.");
            return;
        }
        window.open('<?= BASE_URL ?>/ticket?id=' + idVenta, '_blank');
    }
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>