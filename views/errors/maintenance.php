<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonafide | En Mantenimiento</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./../../img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./../../img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="./../../img/favicon_io/site.webmanifest">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
        }
        .container-maintenance {
            max-width: 500px;
            padding: 30px;
        }
        .maintenance-heading {
            font-size: 2.5rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 0.5rem;
        }
        .maintenance-subtext {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        .social-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            margin: 0 5px;
            background-color: #dc3545; 
        }

        .image-placeholder {
            margin-bottom: 2rem;
        }
        .image-placeholder img {
            object-fit: contain;
        }
    </style>
</head>
<body>

    <div class="container-maintenance">
        
        <div class="image-placeholder mx-auto">
            
            <div class="ratio ratio-1x1 w-175 mx-auto"> 
                
                <img src="<?= BASE_URL ?>/img/logo/LogoRedondo.png" 
                     alt="En Mantenimiento" 
                     class="img-fluid w-100 h-100">
            </div>
            
        </div>

        <h1 class="maintenance-heading">En Mantenimiento</h1>
        <p class="maintenance-subtext">Disculpe las molestias.</p>


        <div>
            <a target="_blank" href="https://web.facebook.com/bonafidetribunales/mentions/?_rdc=1&_rdr#" class="social-icon-btn">
                <i class="bi bi-facebook"></i>
            </a>
            
            <a target="_blank" href="https://www.instagram.com/bonafideconcordia" class="social-icon-btn">
                <i class="bi bi-instagram"></i>
            </a>
            
            <a target="_blank" href="https://api.whatsapp.com/send/?phone=5493455023747&text&type=phone_number&app_absent=0" class="social-icon-btn">
                <i class="bi bi-whatsapp"></i>
            </a>
            
            <a target="_blank" href="https://maps.app.goo.gl/km89GxTB5Gv3iGub7" class="social-icon-btn">
                <i class="bi bi-geo-alt-fill"></i>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>