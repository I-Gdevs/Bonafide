<?php 
include __DIR__ . '/../partials/head.php'; 
include __DIR__ . '/../partials/header.php'; 


$nombre_usuario = "Guido Asplanatti";
$email_usuario = "guido.asplanatti@ejemplo.com";
$perfil_admin = true;
?>

<main>
    <div class="container my-5 fixed-width-container mx-auto">
        
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
                    
                    <a class="list-group-item list-group-item-action" id="list-recetas-list" data-bs-toggle="list" href="#list-recetas" role="tab" aria-controls="list-recetas">
                        <i class="bi bi-journal-text me-2"></i> Mis Recetas
                    </a>

                    <?php if ($perfil_admin): ?>
                    <a class="list-group-item list-group-item-action list-group-item-danger fw-bold" id="list-admin-list" href="/armado-recetas">
                        <i class="bi bi-gear-fill me-2"></i> Armado de Recetas
                    </a>
                    <?php endif; ?>

                    <a class="list-group-item list-group-item-action text-danger mt-3" href="/logout" onclick="deleteCookie('session_id')">
                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                    </a>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="tab-content" id="nav-tabContent">
                    
                    <div class="tab-pane fade show active" id="list-datos" role="tabpanel" aria-labelledby="list-datos-list">
                        <h4 class="fw-bold text-dark mb-4">Actualizar mi Información</h4>
                        <form>
                            <div class="mb-3">
                                <label for="inputNombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="inputNombre" value="<?= htmlspecialchars($nombre_usuario) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" value="<?= htmlspecialchars($email_usuario) ?>" disabled>
                            </div>
                            <div class="mb-4">
                                <label for="inputPassword" class="form-label">Cambiar Contraseña</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Dejar vacío para no cambiar">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="list-pedidos" role="tabpanel" aria-labelledby="list-pedidos-list">
                        <h4 class="fw-bold text-dark mb-4">Mis Últimos Pedidos</h4>
                        <p class="text-muted">
                            Aquí se mostraría una tabla con los pedidos, su estado (Entregado, Pendiente, Cancelado) y el total.
                        </p>
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

                    <div class="tab-pane fade" id="list-recetas" role="tabpanel" aria-labelledby="list-recetas-list">
                         <h4 class="fw-bold text-dark mb-4">Mis Recetas de Acceso</h4>
                        <p class="text-muted">
                            Aquí se listarían las recetas a las que el usuario tiene acceso (todas las recetas del sistema para usuarios comunes).
                        </p>
                        <ul class="list-group">
                            <li class="list-group-item">Receta: Torta Cheesecake Clásica</li>
                            <li class="list-group-item">Receta: Café de Origen Colombia</li>
                            <li class="list-group-item">Receta: Tostados Especiales</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</main>

<?php 
// Asegúrate de que la ruta sea correcta
include __DIR__ . '/../partials/footer.php'; 
?>