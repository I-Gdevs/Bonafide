<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $cartData = json_decode($_POST["cart_data"], true);
        $deliveryType = $_POST['delivery_type'] ?? 'local';

        if (!$cartData || empty($cartData)) {
            setFlash("El carrito está vacío.", "error");
            header("Location: " . BASE_URL . "/shop");
            exit;
        }

        $productList = [];
        $totalPrice = 0;

        foreach ($cartData as $item) {
            $productList[] = [
                "product_id" => $item['id'],
                "product_quantity" => $item['qty'],
                "product_price" => $item['price']
            ];
            $totalPrice += ($item['price'] * $item['qty']);
        }
        
        if ($deliveryType === 'delivery') {
            $totalPrice += 2100; 
        }
        
        $idUsuario = $_SESSION["user"]["user_id"] ?? null;
        $idLocal = $_SESSION['local_id'] ?? 49;
        $metodoPago = $_POST["metodo_pago"] ?? "Efectivo";

        $celular_cliente = $_POST['celular'] ?? '';
        
        $direccion_envio = '';
        if ($deliveryType === 'delivery') {
            $calle = $_POST['calle'] ?? '';
            $numero = $_POST['numero'] ?? '';
            $dpto = $_POST['dpto'] ?? '';
            
            $direccion_envio = trim("$calle $numero $dpto");
        }

        $datosParaApi = [
            "building_id" => $idLocal,
            "user_id" => $idUsuario,
            "sale_total_price" => $totalPrice,
            "payment_method" => $metodoPago,
            "product_list" => $productList,
            "customer_phone" => $celular_cliente,
            "customer_address" => $direccion_envio
        ];

        $response = callApi("POST", "/sales", $datosParaApi);

        if ((isset($response['success']) && $response['success']) || (isset($response["res"]['success']) && $response["res"]['success'])) {
            
            $_SESSION['sale_success'] = true;
            $_SESSION['clear_cart'] = true; 

            // ¡LA RUTA EXACTA HACIA EL ID!
            $saleId = $response['res']['data']['newSaleId'] ?? null;

            $_SESSION['last_sale_id'] = $saleId;

            // Volvemos a poner el mensaje amigable (sacamos el debug)
            setFlash("¡Pedido confirmado con éxito! Tu orden ya está en preparación.", "success");
            
        } else {
            $errorMsg = $response['error'] ?? $response['res']['error'] ?? "Error desconocido al procesar la venta.";
            setFlash($errorMsg, "error");
        }

        $_SESSION["temp_cart"] = $_POST["cart_data"];

        header("Location: " . BASE_URL . "/pay");
        exit;
    }

?>