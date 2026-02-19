<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $cartData = json_decode($_POST["cart_data"], true);
        $deliveryType = $_POST['delivery_type'] ?? 'local';

        if (!$cartData || empty($cartData)) {
            setFlash("El carrito está vacío.", "error");
            header("Location: " . BASE_URL . "/products");
            exit;
        }

        $productList = [];
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
        
        $idUsuario = $_SESSION['user_id'] ?? 83; 
        $idLocal = $_SESSION['local_id'] ?? 49;

        $datosParaApi = [
            "building_id" => $idLocal,
            "user_id" => $idUsuario,
            "sale_total_price" => $totalPrice,
            "product_list" => $productList
        ];

        $response = callApi("POST", "/sales", $datosParaApi);

        if (isset($response['id_venta']) || (isset($response['success']) && $response['success'])) {
            
            $_SESSION['clear_cart'] = true; 
            setFlash("¡Pedido confirmado con éxito! Tu orden ya está en preparación.", "success");
            
        } else {
            $errorMsg = $response['error'] ?? $response['res']['error'] ?? "Error desconocido al procesar la venta.";
            setFlash($errorMsg, "error");
        }

        header("Location: " . BASE_URL . "/products");
        exit;
    }

?>