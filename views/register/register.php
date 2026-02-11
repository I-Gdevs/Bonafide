<?php
    $error = null;
    $success = false;
    $old_data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $old_data = $_POST;

        $user_fullname = $_POST['user_fullname'];
        $user_email = $_POST['user_email'];
        $repeat_user_email = $_POST['repeat_user_email'];
        $user_dni = $_POST['user_dni'];
        $user_password = $_POST['user_password'];
        $repeat_user_password = $_POST['repeat_user_password'];
        $user_nickname = $_POST['user_nickname'];

        if ($user_email != $repeat_user_email) {
            $error = "Los correos electrónicos no coinciden";
        } elseif ($user_password != $repeat_user_password) {
            $error = "Las contraseñas no coinciden";
        } else {

            $userData = json_encode([
                'user_fullname' => $user_fullname,
                'user_email' => $user_email,
                'user_dni' => $user_dni,
                'user_password' => $user_password,
                'user_nickname' => $user_nickname
            ]);

            $curl_req = curl_init(API_URL . '/users');
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
                $success = true;
            } else {
                $error = isset($json_response['error']) ? $json_response['error'] : 'Error al intentar registrar nuevo usuario.';
            }
        }
    }
?>

<head>
    <title>Bonafide | Registrarse</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

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
                    <form method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label fw-bold">Nombre completo</label>
                            <input type="text" class="form-control" name="user_fullname" id="fullname" placeholder="" autocomplete="off" value="<?= htmlspecialchars($old_data['user_fullname'] ?? '') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="dni" class="form-label fw-bold">DNI</label>
                            <input type="text" class="form-control" name="user_dni" id="dni" placeholder="" autocomplete="off" value="<?= htmlspecialchars($old_data['user_dni'] ?? '') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nickname" class="form-label fw-bold">Nombre de usuario</label>
                            <input type="text" class="form-control" name="user_nickname" id="nickname" placeholder="" autocomplete="off" value="<?= htmlspecialchars($old_data['user_nickname'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="user_email" id="email" placeholder="ejemplo@correo.com" value="<?= htmlspecialchars($old_data['user_email'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="repeat_user_email" id="repeatEmail" placeholder="Repetir correo" autocomplete="off" value="<?= htmlspecialchars($old_data['repeat_user_email'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="user_password" id="password" placeholder="********" value="<?= htmlspecialchars($old_data['user_password'] ?? '') ?>" required>
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
                                <input type="password" class="form-control" name="repeat_user_password" id="repeatPassword" placeholder="Repetir contraseña" autocomplete="off" value="<?= htmlspecialchars($old_data['repeat_user_password'] ?? '') ?>" required>
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

<!-- Modal para confirmacion de usuario creado -->
<div class="modal fade" id="registroExitosoModal" tabindex="-1" aria-labelledby="registroExitosoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-body text-center p-5">
                
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#28a745" class="bi bi-check-circle mb-3" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m10.97 4.97a.235.235 0 0 0-.253-.008L7.152 7.749 5.8 6.4a.235.235 0 0 0-.265.01c-.13.11-.13.31 0 .42l1.6 1.6a.475.475 0 0 0 .68 0l3.8-3.8a.475.475 0 0 0 0-.67"/>
                </svg>

                <h4 class="fw-bold mb-3">¡Usuario Registrado con Éxito!</h4>
                <p class="text-muted">Tu cuenta ha sido creada. Ahora puedes iniciar sesión para realizar pedidos.</p>
            </div>
            
            <div class="modal-footer justify-content-center border-top-0 pb-4">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Volver</button>
                
                <a href="<?= BASE_URL ?>/login" class="btn btn-red">Iniciar Sesión</a>
            </div>
            
        </div>
    </div>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>

<!-- Todas las funciones script que usen js de booostrap deben ir despues del footer porque es este el que incluye la libreria de boostrapjs  -->

<!-- Respuesta del php que levanta el modal -->
<script>
    <?php if (isset($success) && $success === true): ?>
        const miModal = new bootstrap.Modal(document.getElementById('registroExitosoModal'));
        miModal.show();

    <?php endif; ?>
</script>
