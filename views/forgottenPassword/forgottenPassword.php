<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<head>
    <title>Recuperar Contraseña</title>
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
                    <h4 class="mb-3 fw-bold">Recuperar Contraseña</h4>
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-red w-50 mt-2">Solicitar código</button>
                        </div>
                        

                        <div class="text-center">
                            <p class="mt-5">¿No tienes cuenta?
                                <a href="<?= BASE_URL ?>/signup" class="btn btn-red btn-sm ms-2">Registrarse</a>
                            </p>
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