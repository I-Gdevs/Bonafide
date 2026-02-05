<?php 
if (!defined('BASE_PATH')) define('BASE_PATH', dirname(__DIR__, 2)); 
if (!defined('BASE_URL')) define('BASE_URL', '/');

include BASE_PATH . '/views/partials/head.php'; 
include BASE_PATH . '/views/partials/header.php'; 

// DATOS SIMULADOS 
$hoy = date('Y-m-d');
$ayer = date('Y-m-d', strtotime('-1 day'));

$comandas = [
    [
        'id' => 801, 'hora' => date('H:i', strtotime('-2 minutes')), 'minutos' => 2, 'estado' => 1, 
        'items' => [['cant'=>1, 'nom'=>'Capuccino', 'hecho'=>false], ['cant'=>2, 'nom'=>'Medialunas', 'hecho'=>false]], 
        'tipo' => 'local', 'sucursal' => 'tribunales', 'fecha' => $hoy
    ],
    [
        'id' => 800, 'hora' => date('H:i', strtotime('-2 minutes')), 'minutos' => 2, 'estado' => 1, 
        'items' => [['cant'=>1, 'nom'=>'Capuccino', 'hecho'=>false], ['cant'=>2, 'nom'=>'Medialunas', 'hecho'=>false]], 
        'tipo' => 'local', 'sucursal' => 'tribunales', 'fecha' => $hoy
    ],
    [
        'id' => 801, 'hora' => date('H:i', strtotime('-2 minutes')), 'minutos' => 2, 'estado' => 1, 
        'items' => [['cant'=>1, 'nom'=>'Capuccino', 'hecho'=>false], ['cant'=>2, 'nom'=>'Medialunas', 'hecho'=>false]], 
        'tipo' => 'local', 'sucursal' => 'tribunales', 'fecha' => $hoy
    ],
    [
        'id' => 801, 'hora' => date('H:i', strtotime('-2 minutes')), 'minutos' => 2, 'estado' => 1, 
        'items' => [['cant'=>1, 'nom'=>'Capuccino', 'hecho'=>false], ['cant'=>2, 'nom'=>'Medialunas', 'hecho'=>false]], 
        'tipo' => 'local', 'sucursal' => 'tribunales', 'fecha' => $hoy
    ],
    [
        'id' => 802, 'hora' => date('H:i', strtotime('-15 minutes')), 'minutos' => 15, 'estado' => 1, 
        'items' => [['cant'=>1, 'nom'=>'Tostado J/Q', 'hecho'=>true]], 
        'tipo' => 'delivery', 'sucursal' => 'centro', 'fecha' => $hoy
    ],
    [
        'id' => 799, 'hora' => date('H:i', strtotime('-30 minutes')), 'minutos' => 30, 'estado' => 2, 
        'items' => [['cant'=>1, 'nom'=>'Cheesecake', 'hecho'=>true]], 
        'tipo' => 'local', 'sucursal' => 'tribunales', 'fecha' => $hoy
    ],
    [
        'id' => 795, 'hora' => '10:00', 'minutos' => 0, 'estado' => 3, 
        'items' => [['cant'=>1, 'nom'=>'Café solo', 'hecho'=>true]], 
        'tipo' => 'takeaway', 'sucursal' => 'centro', 'fecha' => $hoy
    ],
    [
        'id' => 700, 'hora' => '20:00', 'minutos' => 0, 'estado' => 3, 
        'items' => [['cant'=>2, 'nom'=>'Licuados', 'hecho'=>true]], 
        'tipo' => 'local', 'sucursal' => 'tribunales', 'fecha' => $ayer
    ],
];
?>

<style>

    .main-wrapper { max-width: 1320px; margin: 0 auto; padding: 30px 20px; }

    .command-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        overflow: hidden;
        border: 1px solid #e0e0e0;
    }

    .section-header {
        padding: 15px 25px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        transition: background 0.2s;
        user-select: none;
    }
    .section-header:hover { background: #e9ecef; }
    .section-title { font-weight: 800; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; }
    
    .section-body {
        padding: 25px;
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        background: #fff;
        transition: max-height 0.4s ease-out, padding 0.4s ease;
        justify-content: flex-start;
    }
    .section-body.collapsed { max-height: 0; padding: 0; overflow: hidden; }

    .comanda-card {
        flex: 0 0 280px; 
        background: white;
        border-radius: 8px;
        padding: 15px 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        border-top: 6px solid #ccc;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, opacity 0.2s;
    }
    .comanda-card:hover { transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.12); }
    .comanda-card.hidden-card { display: none !important; } /* Clase para el filtro */

    .border-prep { border-top-color: #e53935; }
    .border-ready { border-top-color: #ffca28; }
    .border-done { border-top-color: #4caf50; }
    
    .time-badge {
        font-size: 0.8rem; font-weight: 600; padding: 5px 10px; border-radius: 6px;
        display: flex; align-items: center; gap: 6px; margin: 10px 0;
    }
    .time-ok { background: #e8f5e9; color: #2e7d32; }
    .time-warn { background: #fff8e1; color: #f57f17; }
    .time-late { background: #ffebee; color: #c62828; animation: pulse 2s infinite; }

    .item-list li {
        padding: 6px 0; border-bottom: 1px dashed #eee; cursor: pointer;
        display: flex; justify-content: space-between; font-size: 0.9rem;
    }
    .item-list li.checked span { text-decoration: line-through; color: #bbb; }
    .item-list li.checked i { color: #4caf50 !important; }

    .card-actions { margin-top: auto; padding-top: 15px; display: flex; gap: 8px; }
    .btn-card { flex: 1; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 5px; }

    .chevron-icon { transition: transform 0.3s; }
    .collapsed .chevron-icon { transform: rotate(-90deg); }

    @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.6; } 100% { opacity: 1; } }
</style>

<main class="main-wrapper">
    
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm border gap-3">
        <div class="d-flex gap-3 align-items-center flex-wrap">
            <h4 class="fw-bold m-0 text-danger d-flex align-items-center gap-2">
                <i class="bi bi-grid-1x2-fill"></i> KDS <small class="text-muted fs-6 fw-normal">Cocina</small>
            </h4>
            <div class="vr d-none d-md-block"></div>
            
            <select id="filter-branch" class="form-select form-select-sm" style="width: 160px;" onchange="applyFilters()">
                <option value="all">Todas las Sucursales</option>
                <option value="tribunales">Tribunales</option>
                <option value="centro">Centro</option>
            </select>
            
            <input type="date" id="filter-date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" style="width: 140px;" onchange="applyFilters()">
        </div>
        
        <div class="d-flex gap-2">
            <button class="btn btn-warning btn-sm fw-bold shadow-sm px-3" onclick="alert('Llamando Mozos...')">
                <i class="bi bi-bell-fill"></i> Timbre
            </button>
            <button class="btn btn-info text-white btn-sm fw-bold shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#helpModal">
                <i class="bi bi-question-circle-fill"></i> Ayuda
            </button>
        </div>
    </div>

    <section class="command-section">
        <div class="section-header" onclick="toggleSection('sec-prep')">
            <div class="section-title text-danger">
                <i class="bi bi-fire"></i> 1. A PREPARAR (<span id="count-prep">0</span>)
            </div>
            <i class="bi bi-chevron-down chevron-icon" id="icon-sec-prep"></i>
        </div>
        <div class="section-body" id="sec-prep">
            <?php foreach($comandas as $c): if($c['estado'] != 1) continue; 
                $timeClass = ($c['minutos'] > 20) ? 'time-late' : (($c['minutos'] > 10) ? 'time-warn' : 'time-ok');
            ?>
            <div class="comanda-card border-prep" id="cmd-<?= $c['id'] ?>" 
                 data-branch="<?= $c['sucursal'] ?>" 
                 data-date="<?= $c['fecha'] ?>">
                
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-bold fs-5">#<?= $c['id'] ?></span>
                    <span class="text-muted small"><?= $c['hora'] ?></span>
                </div>
                <div class="d-flex justify-content-between small text-muted fw-bold mb-2">
                    <span class="text-uppercase"><?= $c['tipo'] ?></span>
                    <span class="badge bg-light text-dark border"><?= ucfirst($c['sucursal']) ?></span>
                </div>

                <div class="time-badge <?= $timeClass ?>">
                    <i class="bi bi-stopwatch"></i> <?= $c['minutos'] ?> min
                </div>
                
                <ul class="item-list list-unstyled mb-3">
                    <?php foreach($c['items'] as $i): ?>
                    <li onclick="toggleCheck(this)" class="<?= $i['hecho']?'checked':'' ?>">
                        <span><b><?= $i['cant'] ?></b> <?= $i['nom'] ?></span>
                        <i class="bi bi-circle text-muted" style="font-size:0.8rem"></i>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="card-actions">
                    <button class="btn btn-outline-secondary btn-sm btn-card" onclick="cancelCmd(<?= $c['id'] ?>)">
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-card text-white" onclick="moveCard(<?= $c['id'] ?>, 2)">
                        Listo <i class="bi bi-check-lg"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="command-section">
        <div class="section-header" onclick="toggleSection('sec-dlv')">
            <div class="section-title text-warning">
                <i class="bi bi-bell-fill"></i> 2. A ENTREGAR (<span id="count-dlv">0</span>)
            </div>
            <i class="bi bi-chevron-down chevron-icon" id="icon-sec-dlv"></i>
        </div>
        <div class="section-body" id="sec-dlv">
            <?php foreach($comandas as $c): if($c['estado'] != 2) continue; ?>
            <div class="comanda-card border-ready" id="cmd-<?= $c['id'] ?>" 
                 data-branch="<?= $c['sucursal'] ?>" 
                 data-date="<?= $c['fecha'] ?>">
                 
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-bold fs-5">#<?= $c['id'] ?></span>
                    <span class="text-muted small"><?= $c['hora'] ?></span>
                </div>
                <div class="d-flex justify-content-between small text-muted fw-bold mb-2">
                    <span class="text-uppercase"><?= $c['tipo'] ?></span>
                    <span class="badge bg-light text-dark border"><?= ucfirst($c['sucursal']) ?></span>
                </div>

                <div class="alert alert-warning py-1 small fw-bold text-center mb-2 mt-1">
                    <i class="bi bi-exclamation-circle"></i> Retirar
                </div>

                <ul class="item-list list-unstyled mb-3">
                    <?php foreach($c['items'] as $i): ?>
                    <li class="checked">
                        <span><b><?= $i['cant'] ?></b> <?= $i['nom'] ?></span>
                        <i class="bi bi-check-circle-fill text-success" style="font-size:0.8rem"></i>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="card-actions">
                    <button class="btn btn-outline-danger btn-sm btn-card" onclick="moveCard(<?= $c['id'] ?>, 1)">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                    <button class="btn btn-warning btn-sm btn-card" onclick="moveCard(<?= $c['id'] ?>, 3)">
                        Entregar <i class="bi bi-box-seam"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="command-section">
        <div class="section-header" onclick="toggleSection('sec-hist')">
            <div class="section-title text-success">
                <i class="bi bi-clock-history"></i> 3. HISTORIAL (<span id="count-hist">0</span>)
            </div>
            <i class="bi bi-chevron-down chevron-icon" id="icon-sec-hist"></i>
        </div>
        <div class="section-body collapsed" id="sec-hist">
            <?php foreach($comandas as $c): if($c['estado'] != 3) continue; ?>
            <div class="comanda-card border-done" id="cmd-<?= $c['id'] ?>" style="opacity: 0.7;"
                 data-branch="<?= $c['sucursal'] ?>" 
                 data-date="<?= $c['fecha'] ?>">
                 
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-bold fs-5 text-muted">#<?= $c['id'] ?></span>
                    <span class="badge bg-success">Finalizado</span>
                </div>
                <div class="d-flex justify-content-between small text-muted fw-bold mb-2">
                    <span class="text-uppercase"><?= $c['tipo'] ?></span>
                    <span class="badge bg-light text-dark border"><?= ucfirst($c['sucursal']) ?></span>
                </div>

                <ul class="item-list list-unstyled mb-3 text-muted">
                    <?php foreach($c['items'] as $i): ?>
                    <li><b><?= $i['cant'] ?></b> <?= $i['nom'] ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="card-actions">
                    <button class="btn btn-outline-secondary btn-sm btn-card w-100" onclick="moveCard(<?= $c['id'] ?>, 2)">
                        <i class="bi bi-arrow-counterclockwise"></i> Reclamar
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<div class="modal fade" id="helpModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header fw-bold">Colores de Espera</div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3"><span class="badge bg-success me-3 p-2"> </span> 0-10 min: A tiempo</div>
                <div class="d-flex align-items-center mb-3"><span class="badge bg-warning text-dark me-3 p-2"> </span> 10-20 min: Precaución</div>
                <div class="d-flex align-items-center"><span class="badge bg-danger me-3 p-2"> </span> +20 min: Demorado</div>
            </div>
        </div>
    </div>
</div>

<script>
    function applyFilters() {
        const branch = document.getElementById('filter-branch').value;
        const date = document.getElementById('filter-date').value;
        const cards = document.querySelectorAll('.comanda-card');

        cards.forEach(card => {
            const cardBranch = card.getAttribute('data-branch');
            const cardDate = card.getAttribute('data-date');
            
            const matchBranch = (branch === 'all' || branch === cardBranch);
            const matchDate = (date === cardDate);

            if (matchBranch && matchDate) {
                card.classList.remove('hidden-card');
            } else {
                card.classList.add('hidden-card');
            }
        });
        updateCounters(); 
    }

    function toggleSection(id) {
        const body = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);
        body.classList.toggle('collapsed');
        icon.style.transform = body.classList.contains('collapsed') ? 'rotate(-90deg)' : 'rotate(0deg)';
    }

    function toggleCheck(el) {
        el.classList.toggle('checked');
        const icon = el.querySelector('i');
        if(icon) {
            if(el.classList.contains('checked')) {
                icon.className = 'bi bi-check-circle-fill text-success';
            } else {
                icon.className = 'bi bi-circle text-muted';
            }
        }
    }

    function moveCard(id, newStatus) {
        const card = document.getElementById('cmd-' + id);
        if(!card) return;

        card.style.transform = 'scale(0.95)';
        card.style.opacity = '0.5';

        setTimeout(() => {
            let targetId, actionsHtml, borderClass;

            if (newStatus === 1) { // A Preparar
                targetId = 'sec-prep';
                borderClass = 'border-prep';
                actionsHtml = `
                    <button class="btn btn-outline-secondary btn-sm btn-card" onclick="cancelCmd(${id})"><i class="bi bi-x-lg"></i></button>
                    <button class="btn btn-danger btn-sm btn-card text-white" onclick="moveCard(${id}, 2)">Listo <i class="bi bi-check-lg"></i></button>
                `;
            } else if (newStatus === 2) { // A Entregar
                targetId = 'sec-dlv';
                borderClass = 'border-ready';
                actionsHtml = `
                    <button class="btn btn-outline-danger btn-sm btn-card" onclick="moveCard(${id}, 1)"><i class="bi bi-arrow-counterclockwise"></i></button>
                    <button class="btn btn-warning btn-sm btn-card" onclick="moveCard(${id}, 3)">Entregar <i class="bi bi-box-seam"></i></button>
                `;
            } else { // Historial
                targetId = 'sec-hist';
                borderClass = 'border-done';
                actionsHtml = `
                    <button class="btn btn-outline-secondary btn-sm btn-card w-100" onclick="moveCard(${id}, 2)"><i class="bi bi-arrow-counterclockwise"></i> Reclamar</button>
                `;
            }

            // Actualizar clases y HTML
            card.className = `comanda-card ${borderClass}`;
            if(card.classList.contains('hidden-card')) card.classList.add('hidden-card'); // Mantener oculto si estaba filtrado
            
            card.querySelector('.card-actions').innerHTML = actionsHtml;
            card.style.opacity = (newStatus === 3) ? '0.7' : '1';
            card.style.transform = 'scale(1)';

            // Mover en el DOM
            document.getElementById(targetId).prepend(card);
            
            // Abrir sección si está cerrada
            const targetSection = document.getElementById(targetId);
            if(targetSection.classList.contains('collapsed')) toggleSection(targetId);

            updateCounters();
        }, 200);
    }

    function cancelCmd(id) {
        if(confirm('¿Cancelar comanda #' + id + '?')) {
            moveCard(id, 3);
            document.getElementById('cmd-' + id).style.background = '#ffebee';
        }
    }

    // 5. ACTUALIZAR CONTADORES
    function updateCounters() {
        const sections = ['sec-prep', 'sec-dlv', 'sec-hist'];
        const ids = ['count-prep', 'count-dlv', 'count-hist'];

        sections.forEach((sec, index) => {
            const visibleCards = document.querySelectorAll(`#${sec} .comanda-card:not(.hidden-card)`);
            document.getElementById(ids[index]).innerText = visibleCards.length;
        });
    }

    // Inicializar
    document.addEventListener('DOMContentLoaded', () => {
        applyFilters(); // Aplicar filtro inicial (hoy)
    });
</script>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>