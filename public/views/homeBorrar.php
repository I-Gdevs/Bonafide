<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/header.php'; ?>


<!-- Contenido específico de la página -->
<div class="text-center">
  <!-- Dividir todo lo de abajo con esto de arriba -->

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bonafide</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados -->
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #e53935 !important;
    }
    .nav-link.active {
      font-weight: 600;
      color: #e53935 !important;
    }
    main {
      flex: 1;
    }
    .login-container {
      max-width: 1000px;
      margin: 3rem auto;
    }
    .login-card {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.08);
    }
    .footer {
      background-color: #f9f9f9;
      padding: 2rem 0;
      margin-top: auto;
    }
    .footer h5 {
      font-weight: 700;
      color: #e53935;
    }
    .footer a {
      text-decoration: none;
      color: #333;
    }
    .footer a:hover {
      text-decoration: underline;
    }
    .footer small {
      display: block;
      text-align: center;
      margin-top: 1rem;
      color: #777;
    }
    .btn-red {
      background-color: #e53935;
      color: #fff;
    }
    .btn-red:hover {
      background-color: #c62828;
      color: #fff;
    }
  </style>
</head>
<body>

  

  <!-- MAIN -->
  <main>
    <div class="container login-container">
      <div class="row g-4 align-items-center">
        <!-- Imagen -->
        <div class="col-md-6 text-center">
          <h2 class="mb-3 fw-bold">Iniciar sesión</h2>
          <p>¿No tienes cuenta?... 
            <a href="#" class="btn btn-red btn-sm ms-2">Registrarse</a>
          </p>
          <img src="https://img.freepik.com/fotos-premium/cafe-taza-sobre-fondo-antiguo_200402-8347.jpg" 
               alt="Café y medialunas" class="img-fluid rounded shadow-sm">
        </div>

        <!-- Formulario -->
        <div class="col-md-6">
          <div class="login-card">
            <h4 class="mb-3 fw-bold">Iniciar sesión</h4>
            <form>
              <div class="mb-3">
                <label for="email" class="form-label">Email o D.N.I.</label>
                <input type="email" class="form-control" id="email" placeholder="ejemplo@correo.com">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="********">
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                      <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"/>
                      <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
                    </svg>
                  </button>
                </div>
              </div>
              <button type="submit" class="btn btn-red w-100 mt-2">Iniciar sesión</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
</body>
</html>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>