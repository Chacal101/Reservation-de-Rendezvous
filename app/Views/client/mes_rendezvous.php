<?= $this->include('layout/HeaderClient') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Rendez-vous</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #f8f9fa;
            --accent-color: #3a0ca3;
            --text-dark: #2b2d42;
            --text-light: #f8f9fa;
            --success-color: #4cc9f0;
            --sidebar-width: 250px;
            --header-height: 70px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-dark);
            padding-top: var(--header-height);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: calc(100vh - var(--header-height));
            padding: 2rem;
        }
        
        .page-title {
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .page-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        
        .rdv-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            border: none;
            overflow: hidden;
        }
        
        .rdv-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.15);
        }
        
        .rdv-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 15px;
        }
        
        .rdv-body {
            padding: 20px;
        }
        
        .rdv-service {
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 10px;
        }
        
        .rdv-date {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #6c757d;
        }
        
        .rdv-date i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        .no-rdv {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .no-rdv i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .rdv-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?= $this->include('layout/SidebarClient') ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="page-title">Mes Rendez-vous</h1>

            <?php if (!empty($rendezvous)) : ?>
                <div class="row">
                    <?php foreach ($rendezvous as $rdv) : ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="rdv-card">
                                <div class="rdv-header">
                                    <h5 class="mb-0"><?= esc($rdv['service_nom']) ?></h5>
                                </div>
                                <div class="rdv-body">
                                    <div class="rdv-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?= date('d/m/Y', strtotime(esc($rdv['date_rdv']))) ?>
                                    </div>
                                    <div class="rdv-date">
                                        <i class="fas fa-clock"></i>
                                        <?= esc($rdv['heure_debut']) ?>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="no-rdv">
                    <i class="far fa-calendar-times"></i>
                    <h3>Aucun rendez-vous programmé</h3>
                    <p class="text-muted">Vous n'avez aucun rendez-vous à venir.</p>
                    <a href="<?= site_url('client/services') ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-plus"></i> Prendre rendez-vous
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour gérer les actions sur les rendez-vous
        document.addEventListener('DOMContentLoaded', function() {
            // Boutons d'action (à implémenter selon vos besoins)
            const modifyButtons = document.querySelectorAll('.btn-outline-primary');
            const cancelButtons = document.querySelectorAll('.btn-outline-danger');
            
            modifyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Logique pour modifier un rendez-vous
                    console.log('Modifier le RDV');
                });
            });
            
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Logique pour annuler un rendez-vous
                    if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
                        console.log('Annuler le RDV');
                    }
                });
            });
        });
    </script>
</body>
</html>