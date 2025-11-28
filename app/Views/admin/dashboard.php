<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    :root {
        --primary-dark: #0B0F28;
        --primary-blue: #007bff;
        --secondary-blue: #00d4ff;
        --accent-color: #6c5ce7;
        --light-bg: #f8f9fa;
        --card-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    body {
        background-color: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .dashboard-container {
        padding: 7rem;
        max-width: 1800px;
        margin: 0 auto;
        padding-left: 7px;
        padding-right: 7px;
    }
    
    /* Header Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: var(--primary-dark);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s ease;
        border-left: 4px solid var(--accent-color);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-card .icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: var(--accent-color);
    }
    
    .stat-card h3 {
        font-size: 1rem;
        color: white;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .stat-card .value {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
    }
    
    /* Main Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    @media (max-width: 992px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Graph Cards */
    .graph-card {
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        background: var(--primary-dark);
        color : white ;
    
    
    
    .graph-card h2 {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        color: var(--primary-dark);
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    .graph-card h2 i {
        margin-right: 0.5rem;
        color: var(--accent-color);
    }
    
    /* Table Card */
    .table-card {
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
    }
    
    .table-card h2 {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        color:var(--primary-dark);
        font-weight: 600;
    }
    
    /* Additional Stats */
    .additional-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    /* Time Card Specific */
    .time-card {
        background: var(--primary-dark);
        color: white;
    }
    
    .time-card .value {
        color: white;
    }
    
    /* Market Card Specific */
    .market-card {
        background: var(--primary-dark);
        color: white;
    }
    
    .market-card .value {
        color: white !important;
    }
    
    /* Custom Dot */
    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }
    
</style>

<div class="dashboard-container">
    <!-- Top Stats Cards -->
    <div class="stats-container">
        <!-- Market Card -->
        <div class="stat-card market-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h3>Taux par Mois</h3>
                    <div class="fs-11 mt-3" style="color: white;">
                        <div class="d-flex align-items-center mb-2">
                            <span class="dot" style="background: var(--primary-blue);"></span>
                            <span class="fw-semi-bold">Inscription</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="dot" style="background: var(--secondary-blue);"></span>
                            <span class="fw-semi-bold">Rdv Prise</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="dot" style="background: #ddd;"></span>
                            <span class="fw-semi-bold">Rdv Annulé</span>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <div id="marketChart" style="width: 100px; height: 100px;"></div>
                    <div class="chart-center-text">85%</div>
                </div>
            </div>
        </div>

        <!-- Total RDV -->
        <div class="stat-card">
            <i class="fas fa-calendar-check icon"></i>
            <h3>Total des Rendez-vous</h3>
            <div class="value"><?= $totalRendezvous; ?></div>
            <div class="progress mt-2" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 75%"></div>
            </div>
            <small class="text-muted">+15% vs mois dernier</small>
        </div>

        <!-- Heure actuelle -->
        <div class="stat-card time-card">
            <i class="fas fa-clock icon"></i>
            <h3>Heure Actuelle</h3>
            <div class="value">
                <span id="hour-minute">11:11</span>
                <span class="time-sub-text" id="am-pm">PM</span>
            </div>
            <p class="day-text mb-0" id="full-date" style="color: white;">Loading...</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-grid">
        <!-- Graphique -->
        <div class="graph-card">
            <h2><i class="fas fa-chart-line"></i> Inscriptions par jour</h2>
            <canvas id="clientChart" height="250"></canvas>
        </div>

        <!-- Tableau -->
        <div class="table-card">
            <h2><i class="fas fa-users"></i> Employés Disponibles</h2>
            <div class="mb-3 d-flex justify-content-between">
                <input type="text" id="filter" class="form-control w-50" placeholder="Rechercher...">
                <select id="sort" class="form-select w-45">
                    <option value="id">Trier par ID</option>
                    <option value="nom">Trier par Nom</option>
                    <option value="statut">Trier par Statut</option>
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php if (!empty($employes)) : ?>
                            <?php foreach ($employes as $emp) : ?>
                                <tr>
                                    <td><?= $emp['id_employer']; ?></td>
                                    <td><?= $emp['nom']; ?></td>
                                    <td>
                                        <span class="badge <?= $emp['statut'] === 'Disponible' ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $emp['statut']; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Aucun employé disponible</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- JS -->
<script>
function updateTime() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes().toString().padStart(2, '0');
    let amPm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;

    document.getElementById("hour-minute").textContent = `${hours}:${minutes}`;
    document.getElementById("am-pm").textContent = amPm;
    document.getElementById("full-date").textContent = now.toLocaleDateString('fr-FR', {
        weekday: 'long',
        day: 'numeric',
        month: 'long'
    });
}
updateTime();
setInterval(updateTime, 1000);

// Chart ECharts - market
let marketChart = echarts.init(document.getElementById("marketChart"));
marketChart.setOption({
    series: [{
        type: "pie",
        radius: ["70%", "90%"],
        avoidLabelOverlap: false,
        silent: true,
        label: { show: false },
        data: [
            { value: 33, itemStyle: { color: "#007bff" } },
            { value: 29, itemStyle: { color: "#00d4ff" } },
            { value: 20, itemStyle: { color: "#ddd" } }
        ]
    }]
});

// Client Chart
const clientCtx = document.getElementById('clientChart').getContext('2d');
new Chart(clientCtx, {
    type: 'line',
    data: {
        labels: <?= $dates; ?>,
        datasets: [{
            label: 'Inscriptions',
            data: <?= $totals; ?>,
            borderColor: '#6c5ce7',
            backgroundColor: 'rgba(108, 92, 231, 0.1)',
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Weekly Chart
const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
new Chart(weeklyCtx, {
    type: 'bar',
    data: {
        labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        datasets: [{
            label: 'Rendez-vous',
            data: [12, 19, 8, 15, 22, 10],
            backgroundColor: 'rgba(0, 212, 255, 0.7)'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});

// Status Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Confirmés', 'Annulés', 'En attente'],
        datasets: [{
            data: [45, 25, 30],
            backgroundColor: ['#28a745', '#dc3545', '#ffc107']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});
</script>
<?= $this->endSection() ?>