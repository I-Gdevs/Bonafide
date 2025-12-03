<?php
    $error = null;
    $showSuccessModal = false;
    $old_data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $old_data = $_POST;

        $user_name = $_POST['user_name'];
        $user_dni = $_POST['user_dni'];
        $user_email = $_POST['user_email'];
        $repeat_user_email = $_POST['repeat_user_email'];
        $user_password = $_POST['user_password'];
        $repeat_user_password = $_POST['repeat_user_password'];

        if ($user_email != $repeat_user_email) {
            $error = "Los correos electrónicos no coinciden";
        } elseif ($user_password != $repeat_user_password) {
            $error = "Las contraseñas no coinciden";
        } else {

            $userData = json_encode([
                'user_name' => $user_name,
                'user_dni' => $user_dni,
                'user_email' => $user_email,
                'user_password' => $user_password
            ]);

            $curl_req = curl_init(API_URL . '/user/create');
            curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_req, CURLOPT_POST, true);
            curl_setopt($curl_req, CURLOPT_POSTFIELDS, $userData);
            curl_setopt($curl_req, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($userData)
            ]);

            $curl_res = curl_exec($curl_req);
            $httpInfo = curl_getinfo($curl_req, CURLINFO_HTTP_CODE);
            curl_close($curl_req);

            $json_response = json_decode($curl_res, true);

            if ($httpInfo === 201) {
                $showSuccessModal = true;
                exit;
            } else {
                $error = isset($json_response['error']) ? $json_response['error'] : 'Error al intentar registrar nuevo usuario.';
            }
        }
    }
?>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<head>
    <title>Registrarse</title>
</head>

<main>
    <div class="container login-container">

        <div class="row g-4 align-items-top">
            
            <div class="col-md-6 text-center">
                <img src="https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg" 
                    alt="Café y medialunas" 
                    class="img-fluid rounded shadow-sm">
            </div>

            <div class="col-md-6">
                <div class="login-card">
                    <h4 class="mb-3 fw-bold">Registrarse</h4>
                    <?php if ($error): ?>
                        <div class="alert alert-danger p-2 text-center">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Nombre de usuario</label>
                            <input type="text" class="form-control" name="user_name" id="username" placeholder="" autocomplete="off" value="<?= htmlspecialchars($old_data['user_name'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="dni" class="form-label fw-bold">DNI</label>
                            <input type="text" class="form-control" name="user_dni" id="dni" placeholder="" autocomplete="off" value="<?= htmlspecialchars($old_data['user_dni'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="user_email" id="email" placeholder="ejemplo@correo.com" value="<?= htmlspecialchars($old_data['user_email'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="repeat_user_email" id="repeatEmail" placeholder="repetir correo" autocomplete="off" value="<?= htmlspecialchars($old_data['repeat_user_email'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="user_password" id="password" placeholder="********" value="<?= htmlspecialchars($old_data['user_password'] ?? '') ?>">
                                <button class="input-group-text" type="button" id="togglePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye text-secondary" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" name="repeat_user_password" id="repeatPassword" placeholder="Repetir contraseña" autocomplete="off" value="<?= htmlspecialchars($old_data['repeat_user_password'] ?? '') ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-red w-100 mt-2">Registrarse</button>

                        <div class="text-center">
                            <p class="mt-5">¿Ya estás registrado?
                                <a href="<?= BASE_URL ?>/login" class="btn btn-red btn-sm ms-2">Iniciar sesión</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Mostrar contraseña-->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('active');
    });
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>