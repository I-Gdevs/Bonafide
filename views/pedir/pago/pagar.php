<head>
    <title>Bonafide | Pagar</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<?php
$subtotal = 6300;
$costo_envio = 2100;
$total_final = $subtotal + $costo_envio;
?>

<style>
    

    /* Estilos del resumen de pago (similar al carrito) */
    .resumen-pago-card {
        background-color: #f8f9fa; /* Fondo gris claro */
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
    }
    .resumen-header {
        background-color: #e53935; /* Rojo de Bonafide */
        color: white;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .total-final-line {
        background-color: #e9ecef;
        padding: 10px;
        border-radius: 4px;
        font-size: 1.25rem;
    }
    .btn-confirm-pay {
        background-color: #e53935;
        color: white;
        font-weight: bold;
    }
    .btn-confirm-pay:hover {
        background-color: #c62828;
        color: white;
    }
</style>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
        <h1 class="fw-bold mb-4">Finalizar Pedido y Pago</h1>
        
        <div class="row g-4">
            
            <div class="col-md-7">
                <h3 class="fw-bold text-dark mb-3">1. Datos de Contacto y Entrega</h3>
                
                <form id="formularioPago" action="[URL_CONTROLADOR_PAGO]" method="POST">
                    
                    <div class="card p-4 shadow-sm mb-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Información Personal</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="inputNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="inputNombre" name="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputApellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="inputApellido" name="apellido" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputTelefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="inputTelefono" name="telefono" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" required>
                            </div>
                        </div>
                        
                        <h5 class="fw-bold mb-3 border-bottom pb-2 mt-4">Dirección de Envío</h5>
                         <div class="mb-3">
                            <label for="inputDireccion" class="form-label">Calle y Número</label>
                            <input type="text" class="form-control" id="inputDireccion" name="direccion" required>
                        </div>
                         <div class="mb-3">
                            <label for="inputComentarios" class="form-label">Notas del Pedido (Opcional)</label>
                            <textarea class="form-control" id="inputComentarios" name="comentarios" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-3 mt-5">2. Método de Pago</h3>
                    
                    <div class="card p-4 shadow-sm mb-4">
                        <div class="alert alert-info small" role="alert">
                            Nota: Aquí se integraría la API de Mercado Pago o similar.
                        </div>

                        <div class="mb-3">
                            <label for="inputTarjeta" class="form-label">Número de Tarjeta</label>
                            <input type="text" class="form-control" id="inputTarjeta" placeholder="XXXX XXXX XXXX XXXX" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="inputVencimiento" class="form-label">Vencimiento (MM/AA)</label>
                                <input type="text" class="form-control" id="inputVencimiento" placeholder="MM/AA" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputCVV" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="inputCVV" placeholder="123" required>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-confirm-pay btn-lg w-100 py-3 mt-4">
                        Confirmar y Pagar $<?= number_format($total_final, 0, ',', '.') ?>
                    </button>
                </form>
            </div>
            
            <div class="col-md-5">
                <div class="resumen-pago-card sticky-top" style="top: 20px;">
                    
                    <div class="resumen-header">
                        Resumen de la Orden
                    </div>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>2x Café Negro Simple</span>
                            <span>$4200</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>1x Submarino de Chocolate</span>
                            <span>$3400</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>2x Medialunas Saladas</span>
                            <span>$800</span>
                        </li>
                    </ul>
                    
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Subtotal</span>
                        <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between small mb-3">
                        <span>Costo de Envío</span>
                        <span>$<?= number_format($costo_envio, 0, ',', '.') ?></span>
                    </div>
                    
                    <div class="total-final-line d-flex justify-content-between fw-bold mt-3">
                        <span>TOTAL FINAL</span>
                        <span class="text-danger">$<?= number_format($total_final, 0, ',', '.') ?></span>
                    </div>
                    
                </div>
            </div>

        </div>
        
    </div>
</main>


<?php 
include BASE_PATH . '/views/partials/footer.php';
?>