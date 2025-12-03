<?php
    function callApi($method, $endpoint, $data = false) {
        
        // Instanciamos todo para consumir la API
        $url = API_URL . $endpoint;
        $curl = curl_init();
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        // Nos fijamos si el usuario ya inició sesión y tomamos el token
        if (isset($_SESSION['token'])) {
            $headers[] = 'Authorization: Bearer ' . $_SESSION['token'];
        }

        // Nos fijamos qué método vamos a ejecutar contra la API
        switch ($method) {
            
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            
            case "PATCH":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
        }

        // Seteamos todo lo preparado para curl
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($result === false) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return [
                "ok" => false,
                "status" => 0,
                "data" => ["error" => "Error de conexión con la API: " . $error_msg]
            ];
        }

        curl_close($curl);

        return [
            "ok" => ($httpCode >= 200 && $httpCode < 300),
            "status" => $httpCode,
            "data" => json_decode($result, true)
        ];
    }
?>