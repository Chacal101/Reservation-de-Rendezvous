<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fichier CSS personnalisé -->
    <link rel="stylesheet" href="<?= base_url('assets/css/registerclient.css') ?>">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="form-container p-4 shadow-lg rounded">
        <h2 class="text-center title mb-4">Inscription</h2>

        <form action="<?= site_url('auth/processRegister') ?>" method="post">
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="text" name="nom" class="form-control" placeholder="Nom" required>
            </div>

            <div class="mb-3">
                <label class="form-label"></label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <label class="form-label"></label>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Créer un compte</button>
        </form>

        <p class="mt-3 parag text-center">Déjà inscrit ? 
            <a href="<?= site_url('auth/login') ?>" class="text-primary">Se connecter</a>
        </p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Fichier JS -->
<script src="script.js"></script>

</body>
</html>
