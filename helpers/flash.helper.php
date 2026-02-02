<?php
    function setFlash($message, $type = "success") {
        $_SESSION["flash_message"] = [
            "message" => $message,
            "type" => $type
        ];
    }

    function getFlash() {
        if (isset($_SESSION["flash_message"])) {
            $message = $_SESSION["flash_message"];
            unset($_SESSION["flash_message"]);
            return $message;
        }
        return null;
    }
?>