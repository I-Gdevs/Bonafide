<?php 
    if (isset($_SESSION['token'])) {
        $nombreUsuario = $_SESSION['user']['user_name'];
    }
?>

<header>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>/home">Bonafide</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/seleccionarLocal">Pedir</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/nosotros">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/products">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/stock">Stock</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/comandas">Comandas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/administracion">Administración</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= (isset($_SESSION["user"]) && $_SESSION["user"]["user_nickname"] != "") ? BASE_URL . '/perfil' :  BASE_URL . '/login' ?>">
                            <?= (isset($_SESSION["user"]) && $_SESSION["user"]["user_nickname"] != "") ? "Mi Perfil" : "Iniciar sesión" ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>