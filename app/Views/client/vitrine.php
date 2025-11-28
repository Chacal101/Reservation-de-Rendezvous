<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Prestations | [Nom de votre entreprise]</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
        }
        
        body {
            background-color: var(--secondary-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 5rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 20px 20px;
        }
        
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 30px;
            height: 100%;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .card-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.2rem;
            font-size: 1.4rem;
        }
        
        .price-tag {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent-color);
            margin: 1.2rem 0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 3rem;
            font-weight: 700;
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            margin: 15px auto 0;
            border-radius: 2px;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Nos Prestations d'Excellence</h1>
            <p class="lead">Découvrez notre gamme de services professionnels conçus pour répondre à vos besoins</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="container mb-5">
        <h2 class="text-center section-title">Nos Services Premium</h2>
        
        <div class="row g-4">
            <?php foreach ($services as $service) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card card shadow">
                        <div class="card-body text-center">
                            <div class="icon-box mb-4">
                                <i class="fas fa-star fa-3x text-warning"></i>
                            </div>
                            <h3 class="card-title"><?= esc($service['service']) ?></h3>
                            <p class="card-text"><?= esc($service['description']) ?></p>
                            <div class="price-tag"><?= esc($service['Prix']) ?> Ariary</div>
                            <a href="<?= site_url('client/prendreRendezVous/' . $service['id_service']) ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Prendre RDV
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Prêt à profiter de nos services ?</h2>
            <a href="#contact" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-phone-alt me-2"></i>Contactez-nous
            </a>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html> 