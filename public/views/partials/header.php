<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/styles.css"> 
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>


 

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
  <nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">Bonafide</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Pedir</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Nosotros</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Stock</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Pedidos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Estadística</a></li>
          <li class="nav-item ms-2">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14a5 5 0 0 0-5-5z"/>
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>