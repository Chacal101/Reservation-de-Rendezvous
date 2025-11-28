<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil - Réservation et Gestion</title>
    <!-- Lien vers Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body et background */
        body {
            background-image: url('<?= base_url('assets/img/Bghome.jpg') ?>');
            font-family: 'Arial', sans-serif;
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);

        }
        /* Conteneur principal */
        .hero-text {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        .btn-custom {
            font-size: 1.1rem;
            padding: 15px 25px;
            width: 45%;
            margin: 10px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-admin {
            background-color: #007bff;
            color: white;
        }

        .btn-client {
            background-color: #28a745;
            color: white;
        }

        .btn-custom:hover {
            transform: scale(1.1);
        }

        .btn-admin:hover {
            background-color: #0056b3;
        }

        .btn-client:hover {
            background-color: #218838;
        }

        /* Animation fade-in */
        .fadeIn {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsivité */
        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2rem;
            }

            .btn-custom {
                font-size: 1rem;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Section d'accueil avec image de fond -->
    <div class="hero-section fadeIn">
        <div class="logo">
            <img src="<?= base_url('assets/img/Logo.png ') ?>" alt="" srcset="">
        </div>
        <div class="hero-text">
            <h2 style="
            font-family: cursive;
            color: mintcream;
        ">Bienvenue dans RANDEVWEB</h2>
            <h2 style="
            font-family: fantasy;
            color: brown;
            text-shadow: white;
        ">Gestion de Rendez-Vous</h2>
            <p>Choisissez votre mode d'accès.</p>
            <!-- Boutons Admin et Client -->
            <div class="d-flex justify-content-center">
                <a href="<?= site_url('admin/login') ?>" class="btn btn-custom btn-admin">Mode Admin</a>
                <a href="<?= site_url('client/vitrine') ?>" class="btn btn-custom btn-client">Mode Client</a>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap 5 et animation -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation de la page d'accueil (fade-in)
        document.addEventListener('DOMContentLoaded', function () {
            const heroSection = document.querySelector('.hero-section');
            heroSection.classList.add('fadeIn');
        });
    </script>
</body>

</html>
