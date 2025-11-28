<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lien vers les fichiers CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/loginclient.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
    <style>
        :root {
            --primary-color: #4361ee;
            --accent-color: #3a0ca3;
            --success-color: #28a745; /* Nouvelle couleur verte */
            --text-dark: #2b2d42;
            --text-light: #f8f9fa;
        }

        .form_container {
            max-width: 400px;
            width: 90%;
            margin: 5% auto;
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        .title_container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 0.5rem;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .subtitle {
            font-size: 1rem;
            color: var(--text-light);
            opacity: 0.9;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .input_container {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input_field {
            width: 75%;
            padding: 0.8rem 1rem 0.8rem 3rem; /* Augmenté pour les nouvelles icônes */
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            font-family: 'Poppins', sans-serif;
        }

        .input_field::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .input_field:focus {
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
            outline: none;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .icon {
            position: absolute;
            left: 12px;
            top: 52%;
            transform: translateY(-50%);
            color: black;
            z-index: 2;
            font-size: 1.5rem;  
        }

        .sign-in_btn {
            width: 100%;
            padding: 0.8rem;
            background: var(--success-color); /* Couleur verte */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sign-in_btn:hover {
            background: #218838; /* Vert plus foncé au survol */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .sign-in_btn:active {
            transform: translateY(0);
        }

        .form_container a {
            color: var(--text-light) !important;
            font-weight: 500;
            text-decoration: none !important;
            transition: all 0.2s ease;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .form_container a:hover {
            text-decoration: underline !important;
            opacity: 0.9;
        }

        .note {
            font-size: 0.75rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 1.5rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        /* Nouveaux styles pour les icônes supplémentaires */
        .input-with-icon {
            position: relative;
        }

        .input-icon-left {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
        }

        .input-icon-right {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .form_container {
                padding: 1.5rem;
                margin: 10% auto;
            }
            
            .title {
                font-size: 1.75rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form_container {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body>

<form class="form_container" action="<?= site_url('auth/processLogin') ?>" method="post">
  <div class="title_container">
    <p class="title">Connexion</p>
    <span class="subtitle">Pour obtenir plus d'avantages</span>
  </div>
  <?php if (session()->getFlashdata('error')): ?>
        <div style="color:red;" class="alert alert-danger">
            <p><?= esc(session()->getFlashdata('error')) ?></p>
        </div>
    <?php endif; ?>
  <div class="input_container input-with-icon">
    <label class="input_label" for="email_field"></label>
    <i class="bi bi-envelope-fill icon"></i>
    <i class="bi bi-check-circle-fill input-icon-right" id="email-check-icon" style="display: none;"></i>
    <input placeholder="name@mail.com" title="Email" name="email" required type="email" class="input_field" id="email_field">
  </div>
  
  <div class="input_container input-with-icon">
    <label class="input_label" for="password_field"></label>
    <i class="bi bi-lock-fill icon"></i>
    <i class="bi bi-eye-fill input-icon-right" id="toggle-password"></i>
    <input placeholder="Mot de passe" title="Mot de passe" type="password" name="password" required class="input_field" id="password_field">
  </div>
  
  <button title="Sign In" type="submit" class="sign-in_btn">
    <i class="bi bi-box-arrow-in-right"></i>
    <span>Se Connecter</span>
  </button>
  
  <div style="text-align: center; margin-top: 1rem;">
    <span style="color: rgba(255, 255, 255, 0.9);">Pas encore inscrit ? <a href="<?= site_url('auth/register') ?>">Créer un compte</a></span>
  </div>
  
  <p class="note">Conditions générales d'utilisation</p>
</form>

<script>
    // Fonction pour basculer la visibilité du mot de passe
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password_field');
        const icon = this;
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    });

    // Validation de l'email en temps réel
    document.getElementById('email_field').addEventListener('input', function() {
        const email = this.value;
        const emailCheckIcon = document.getElementById('email-check-icon');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (emailRegex.test(email)) {
            emailCheckIcon.style.display = 'block';
            emailCheckIcon.style.color = '#28a745'; // Vert
        } else {
            emailCheckIcon.style.display = 'none';
        }
    });
</script>

</body>
</html>