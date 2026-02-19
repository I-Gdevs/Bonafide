<?php
    include BASE_PATH . '/views/partials/head.php'; 
    include BASE_PATH . '/views/partials/header.php'; 

    $productos_checkout = isset($_POST['cart_data']) ? json_decode($_POST['cart_data'], true) : [];
    $tipo_entrega = $_POST['delivery_type'] ?? 'local';
    $sucursal_id = $_POST['sucursal'] ?? 'tribunales';

    $sucursales = [
        'tribunales' => ['nombre' => 'Bonafide Tribunales', 'direccion' => 'Talcahuano 550, CABA'],
        'centro' => ['nombre' => 'Bonafide Centro', 'direccion' => 'Av. Corrientes 800, CABA']
    ];

    $costo_envio = ($tipo_entrega === 'delivery') ? 2100 : 0;
    $subtotal = 0;
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
                    <input type="hidden" name="cart_data" value="<?= htmlspecialchars($_POST["cart_data"] ?? "[]", ENT_QUOTES, "UTF-8") ?>">
                    <input type="hidden" name="delivery_type" value="<?= htmlspecialchars($tipo_entrega) ?>">
                    <input type="hidden" name="sucursal" value="<?= htmlspecialchars($sucursal_id) ?>">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="fw-bold small">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small">Apellido</label>
                            <input type="text" name="apellido" class="form-control" required>
                        </div>
                        
                        <?php if ($tipo_entrega === 'delivery'): ?>
                        <div class="row g-2 justify-content-between">
                            <div class="col-md-6">
                                <label class="fw-bold small">Calle</label>
                                <input type="text" name="direccion" class="form-control" placeholder="Calle" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fw-bold small">Número</label>
                                <input type="text" name="direccion" class="form-control" placeholder="Número" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fw-bold small">Departamento</label>
                                <input type="text" name="direccion" class="form-control" placeholder="Dpto." required>
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
                                <input type="text" name="correo" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="fw-bold">Tarjeta de Crédito / Débito</h6>
                            <div class="p-3 border rounded bg-light">
                                <input type="text" class="form-control mb-2" placeholder="0000 0000 0000 0000" required>
                                <div class="row">
                                    <div class="col-6"><input type="text" class="form-control" placeholder="MM/AA" required></div>
                                    <div class="col-6"><input type="text" class="form-control" placeholder="CVC" required></div>
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
                    <div class="fw-bold"><?= $sucursales[$sucursal_id]['nombre'] ?></div>
                    <div class="text-muted small"><?= $sucursales[$sucursal_id]['direccion'] ?></div>
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
        <button class="btn btn-danger w-100" onclick="clearAndGo()">Cerrar</button>
    </div>
</div>

<script>
    function showFinalPopup() {
        const form = document.getElementById('main-payment-form');
        
        if(form.checkValidity()) {
            
            const btn = document.querySelector('button[onclick="showFinalPopup()"]');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Procesando...';
            btn.disabled = true;

            form.submit();
            
        } else {
            form.reportValidity(); 
        }    }
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>