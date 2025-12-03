<head>
    <title>Login</title>
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
                    <h4 class="mb-3 fw-bold">Iniciar sesión</h4>

                    <?php if ($success_msg): ?>
                        <div class="alert alert-success text-center"><?= $success_msg ?></div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="user_email" id="email" placeholder="ejemplo@correo.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="user_password" id="password" placeholder="********">
                                <button class="input-group-text" type="button" id="togglePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye text-secondary" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-red w-100 mt-2">Iniciar sesión</button>

                        <div class="text-center">
                            <p class="mt-5">¿No tienes cuenta?
                                <a href="<?= BASE_URL ?>/signup" class="btn btn-red btn-sm ms-2">Registrarse</a>
                            </p>
                            <a href="<?= BASE_URL ?>/forgottenPassword" class="ms-2 text-dark text-decoration-none">Olvidé mi contraseña</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

  <!-- Script para mostrar/ocultar contraseña -->
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