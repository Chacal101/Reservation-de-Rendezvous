<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #f8f9fa;
            --accent-color: #3a0ca3;
            --sidebar-width: 250px;
            --header-height: 70px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            overflow-x: hidden;
        }

        /* Layout Structure */
        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            left: 0;
            top: var(--header-height);
            background: #fff;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 900;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        /* Header styling */
        .header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--header-height);
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            transition: all 0.3s ease;
        }

        /* Service Cards */
        .service-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: none;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.15) !important;
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }

        /* Page Title */
        .page-title {
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 2rem;
            position: relative;
            text-align: center;
        }

        .page-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .header {
                left: 0;
            }

            .content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .sidebar-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-open .content {
                margin-left: var(--sidebar-width);
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 1rem;
            }

            .card-img-top {
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <!-- Inclusion du Header -->
    <?php include APPPATH . 'Views/layout/HeaderClient.php'; ?>

    <div class="main-container">
        <!-- Inclusion du Sidebar -->
        <div class="sidebar">
            <?php include APPPATH . 'Views/layout/SidebarClient.php'; ?>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <h1 class="page-title">Nos Services</h1>

            <?php
// Définition des images pour chaque service
$serviceImages = [
    'Formation Préstashop.' => 'formationPresta.jpeg',
    'Formation PHP' => 'formationPHP.jpeg',
    'Formation JavaScript' => 'formationJS.jpeg',
    'Formation PYTHON' => 'formationPython.jpeg',
    'Formation Java JRE' => 'formationJava.jpeg',
    'Formation Odoo' => 'formationOdoo.jpeg',
    'Formation HTML Simple' => 'formationHTML.jpeg',
    'Formation CSS' => 'formationCSS.jpeg',
    'Formation React Native' => 'formationReact.jpeg',
    'Formation Wordpress' => 'formationWordpress.jpeg'
    // Ajoutez d'autres services et leurs images ici
];
$defaultImage = 'default_service.jpg'; // Image par défaut
?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($services as $service): ?>
                    <div class="col">
                        <div class="card service-card shadow-sm h-100">
                            <img src="<?=base_url('assets/img/' . ($serviceImages[esc($service['service'])] ?? $defaultImage))?>"
                                 class="card-img-top"
                                 alt="<?=esc($service['service'])?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=esc($service['service'])?></h5>
                                <p class="card-text text-muted"><?=esc($service['description'])?></p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold"><?=esc($service['Prix'])?> Ar</span>
                                    <a href="<?=site_url('client/prendreRendezVous/' . $service['id_service'])?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-calendar-check me-1"></i> RDV
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
                <!-- PAGINATION -->
                <?php if (isset($pager)): ?>
                    <div class="mt-5 d-flex justify-content-center">
                        <nav>
                            <ul class="pagination">
                                <?=$pager->simpleLinks('default', 'default_full')?>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('[data-bs-toggle="sidebar"]');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.body.classList.toggle('sidebar-open');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 992 && !e.target.closest('.sidebar') && !e.target.closest('[data-bs-toggle="sidebar"]')) {
                    document.body.classList.remove('sidebar-open');
                }
            });
        });
        
    </script>
</body>
</html>

<style>
.pagination {
    display: flex;
    justify-content: center;
    padding-left: 0;
    list-style: none;
    gap: 8px;
}

.pagination li a {
    display: inline-block;
    padding: 10px 16px;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.2s, color 0.2s;
}

.pagination li a:hover {
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
}

.pagination li.active a {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
    font-weight: bold;
}

.pagination li.disabled a {
    color: #6c757d;
    pointer-events: none;
    background-color: #f8f9fa;
}
</style>
