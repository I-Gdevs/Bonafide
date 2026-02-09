<head>
    <title>Bonafide | Perfil</title>
</head>

<?php include BASE_PATH . '/views/partials/head.php'; ?>
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<main>
    <div class="container my-3 fixed-width-container mx-auto">
        
        <h1 class="fw-bold mb-4">Mi Perfil</h1>
        
        <div class="row g-4">
            
            <div class="col-md-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-datos-list" data-bs-toggle="list" href="#list-datos" role="tab" aria-controls="list-datos">
                        <i class="bi bi-person-circle me-2"></i> Datos Personales
                    </a>
                    
                    <a class="list-group-item list-group-item-action" id="list-pedidos-list" data-bs-toggle="list" href="#list-pedidos" role="tab" aria-controls="list-pedidos">
                        <i class="bi bi-box-seam me-2"></i> Historial de Pedidos
                    </a>                

                    <a class="list-group-item list-group-item-action mt-3" href="<?= BASE_URL?>/logout">
                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                    </a>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="tab-content" id="nav-tabContent">
                    
                    <div class="tab-pane fade show active" id="list-datos" role="tabpanel" aria-labelledby="list-datos-list">
                        <h4 class="fw-bold text-dark mb-3">Información personal</h4>
                        <form>
                            <div class="row g-4 mb-4">
                                <div class="col-5">
                                    <label for="inputNombreCompleto" class="form-label">Nombre completo</label>
                                    <input disabled type="text" class="form-control" id="input_nickname" value="<?= $_SESSION["user"]["user_fullname"] ?>">
                                </div>
                                
                                <div class="col-3">
                                    <label for="inputDni" class="form-label">DNI</label>
                                    <input disabled type="text" class="form-control" id="input_nickname" value="<?= $_SESSION["user"]["user_dni"] ?>">
                                </div>

                            </div>
                            <div class="row g-4 mb-4">
                                <div class="col-3">
                                    <label for="inputNombre" class="form-label">Nombre de usuario</label>
                                    <input disabled type="text" class="form-control" id="input_nombre_completo" value="<?= $_SESSION["user"]["user_nickname"] ?>">
                                </div>
                                <div class="col-4">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input disabled type="text" class="form-control" id="input_email" value="<?= $_SESSION["user"]["user_email"] ?>">
                                </div>
                            </div>
                        </form>

                        <hr>

                        <h4 class="fw-bold text-dark mb-3">Cambiar email</h4>

                        <form method="POST" action="">
                            <div class="row g-4 mb-4">
                                <div class="col-4">
                                    <label for="inputNewEmail" class="form-label">Nuevo email</label>
                                    <input type="email" class="form-control" id="inputNewEmail" value="" required>
                                </div>
                                <div class="col-4">
                                    <label for="inputRepeatNewEmail" class="form-label">Repetir nuevo email</label>
                                    <input type="email" class="form-control" id="inputRepeatNewEmail" value="" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger">Cambiar contraseña</button>
                        </form>

                        <hr>

                        <h4 class="fw-bold text-dark mb-3">Contraseña</h4>

                        <form action="">
                            <div class="row g-4 mb-4">
                                <div class="col-5">
                                    <label for="oldPassword" class="form-label">Contraseña actual</label>
                                    <input required type="password" class="form-control" id="oldPassword" placeholder="Ingrese su contraseña actual">
                                </div>
                            </div>
    
                            <div class="row g-4 mb-4">
                                <div class="col-5">
                                    <label for="newPassword" class="form-label">Contraseña nueva</label>
                                    <input required type="password" class="form-control" id="newPassword">
                                </div>
                                <div class="col-5">
                                    <label for="repeatNewPassword" class="form-label">Repetir contraseña nueva</label>
                                    <input required type="password" class="form-control" id="repeatNewPassword">
                                </div>
    
                            </div>
                            <button type="submit" class="btn btn-danger">Cambiar contraseña</button>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="list-pedidos" role="tabpanel" aria-labelledby="list-pedidos-list">
                        <h4 class="fw-bold text-dark mb-4">Mis Últimos Pedidos</h4>
                        <div class="card p-3 shadow-sm mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">Pedido #20250105</h6>
                                    <small class="text-muted">Fecha: 05/01/2025</small>
                                </div>
                                <div>
                                    <span class="badge bg-success me-3">Entregado</span>
                                    <span class="fw-bold">$4.500</span>
                                </div>
                            </div>
                            <small class="mt-2 text-primary">Ver Detalles</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</main>


<?php include BASE_PATH . '/views/partials/footer.php'; ?> 