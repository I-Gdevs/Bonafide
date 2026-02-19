<?php
$sale_id = $_GET['id'] ?? null;

if (!$sale_id) {
    die("Error: No se proporcionó un ID de venta válido.");
}

$response = callApi("GET", "/sales/" . $sale_id);

$apiBody = $response['res'] ?? $response;

if (!isset($apiBody['success']) || !$apiBody['success']) {
    die("Error de la API: " . json_encode($response)); 
}

$venta = $apiBody['res'] ?? null;

if (!$venta) {
    die("Error: La venta no tiene datos.");
}

$factura_nro = str_pad($venta['id_venta'], 6, '0', STR_PAD_LEFT); 
$fecha_hora = date('d/m/Y H:i', strtotime($venta['fecha_cobro'])); 

$cliente_nombre = $venta['nombre_usuario'];
$cliente_dni = $venta['dni_usuario'];
$metodo_pago = $venta['metodo_pago'];
$total = (float)$venta['precio_total_venta'];
$direccion = $venta['direccion_envio'] ?? null;

$costo_envio = 0;
if (!empty($direccion)) {
    $costo_envio = 2100;
}
$subtotal = $total - $costo_envio;

$productos = $venta['productos'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Factura #<?= $factura_nro ?></title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 400px; margin: 25px auto; background-color: #ffffff; padding: 25px; border: 1px solid #ddd; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); }
        .header, .details, .items, .totals, .footer { width: 100%; border-collapse: collapse; }
        .logo-area { padding-bottom: 15px; }
        .items th, .items td { padding: 7px 0; text-align: left; }
        .items th { text-transform: uppercase; font-weight: bold; font-size: 10px; border-bottom: 1px solid #333; }
        .items td { font-size: 11px; border-bottom: 1px dashed #ccc; }
        .totals td { padding-top: 8px; font-weight: bold; }
        
        /* Ocultar botón de imprimir al imprimir */
        @media print {
            body { background-color: #fff; margin: 0; padding: 0; font-size: 10px; }
            .container { max-width: 100%; margin: 0; padding: 0; border: none; box-shadow: none; }
            .items td { word-wrap: break-word; white-space: normal; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body style="background-color: #f4f4f4; font-family: Arial, sans-serif; line-height: 1.5;">

    <div class="container" style="max-width: 400px; margin: 25px auto; background-color: #ffffff; padding: 25px; border: 1px solid #ddd; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);">

        <table class="header" style="width: 100%; text-align: center; margin-bottom: 15px;">
            <tr>
                <td align="center" class="logo-area">
                    <img src="<?= BASE_URL ?>/img/logo/LogoRedondo.png" alt="Logo" width="100" height="auto" style="display: block; margin: 0 auto;">
                </td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;">
                    <strong style="color: #D92027; font-size: 15px;">Factura "B"</strong>
                </td>
            </tr>
            <tr>
                <td><span style="font-size: 11px; color: #555;">Mitre 37 - Tribunales</span></td>
            </tr>
        </table>

        <div style="border-top: 1px dashed #ccc; margin-bottom: 15px;"></div>

        <table class="details" style="width: 100%; margin-bottom: 15px; font-size: 11px;">
            <tr>
                <td style="width: 50%; padding-bottom: 5px;"><strong>N° Factura:</strong> <?= $factura_nro ?></td>
                <td style="width: 50%; padding-bottom: 5px;"><strong>Fecha:</strong> <?= $fecha_hora ?></td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><strong>Cliente:</strong> <?= htmlspecialchars($cliente_nombre) ?></td>
                <td style="padding-bottom: 5px;"><strong>CUIT/ID:</strong> <?= htmlspecialchars($cliente_dni) ?></td>
            </tr>
            <?php if (!empty($direccion)): ?>
            <tr>
                <td colspan="2" style="padding-bottom: 5px;"><strong>Envío a:</strong> <?= htmlspecialchars($direccion) ?></td>
            </tr>
            <?php endif; ?>
        </table>

        <table class="items" style="width: 100%; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="width: 35%; text-align: left;">Producto</th>
                    <th style="width: 25%; text-align: right;">Cant.</th>
                    <th style="width: 20%; text-align: right;">P. Unit.</th>
                    <th style="width: 20%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $prod): 
                    $precio_unitario = (float)$prod['precio_producto'];
                    $cantidad = (int)$prod['cantidad_producto'];
                    $total_linea = $precio_unitario * $cantidad;
                ?>
                <tr>
                    <td style="padding: 7px 0; border-bottom: 1px dashed #ccc;"><?= htmlspecialchars($prod['nombre_producto']) ?></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;"><?= $cantidad ?></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;">$ <?= number_format($precio_unitario, 0, ',', '.') ?></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;">$ <?= number_format($total_linea, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table class="totals" style="width: 100%; font-size: 11px; border-top: 1px solid #333; margin-bottom: 20px;">
            <tr>
                <td style="width: 70%; text-align: right; padding-top: 10px;">Subtotal:</td>
                <td style="width: 30%; text-align: right; padding-top: 10px;">$ <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
            
            <?php if ($costo_envio > 0): ?>
            <tr>
                <td style="width: 70%; text-align: right; padding-top: 5px;">Envío:</td>
                <td style="width: 30%; text-align: right; padding-top: 5px;">$ <?= number_format($costo_envio, 0, ',', '.') ?></td>
            </tr>
            <?php endif; ?>

            <tr>
                <td style="width: 70%; text-align: right; border-top: 1px solid #333; padding-top: 10px; font-size: 15px;">
                    <strong>TOTAL A PAGAR:</strong>
                </td>
                <td style="width: 30%; text-align: right; border-top: 1px solid #333; padding-top: 10px; font-size: 15px; color: #D92027;">
                    <strong>$ <?= number_format($total, 0, ',', '.') ?></strong>
                </td>
            </tr>
        </table>

        <table class="footer" style="width: 100%; text-align: center; font-size: 11px;">
            <tr>
                <td style="padding-bottom: 8px;">
                    <p style="margin: 0; font-style: italic; color: #333;">¡Gracias por su compra!</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0; font-size: 10px; color: #333;">
                        Método de Pago: <?= htmlspecialchars($metodo_pago) ?>
                    </p>
                </td>
            </tr>
        </table>
        
        <div class="no-print" style="text-align: center; margin-top: 20px;">
            <button onclick="window.print()" style="background: #D92027; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Imprimir ahora
            </button>
        </div>

    </div>
</body>
</html>
<?php exit; ?>