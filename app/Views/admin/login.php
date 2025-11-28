<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Administrateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background-image: url(/assets/img/AdminBg.jpg);
      background-size: cover;
      background-position: center;
    }
    .login-container {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 10px;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .form {
      --bg-light: #efefef;
      --bg-dark: #707070;
      --clr: #58bc82;
      --clr-alpha: #9c9c9c60;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      width: 100%;
      max-width: 300px;
    }
    .form .input-span {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      position: relative;
    }
    .form input[type="email"],
    .form input[type="password"] {
      border-radius: 0.5rem;
      padding: 1rem 2.5rem 1rem 2.5rem;
      width: 100%;
      border: none;
      background-color: var(--clr-alpha);
      outline: 2px solid var(--bg-dark);
    }
    .form input:focus {
      outline: 2px solid var(--clr);
    }
    .label {
      align-self: flex-start;
      color: var(--clr);
      font-weight: 600;
    }
    .form .submit {
      padding: 1rem 0.75rem;
      width: 100%;
      border-radius: 3rem;
      background-color: var(--bg-dark);
      color: var(--bg-light);
      border: none;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.9rem;
    }
    .form .submit:hover {
      background-color: var(--clr);
      color: var(--bg-dark);
    }
    .span {
      text-decoration: none;
      color: var(--bg-dark);
    }
    .span a {
      color: var(--clr);
    }
    .icon-field {
      position: absolute;
      left: 10px;
      top: 67%;
      transform: translateY(-50%);
      color: #555;
    }
    .icon-check {
      position: absolute;
      right: 10px;
      top: 67%;
      transform: translateY(-50%);
      color: green;
      display: none;
    }
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 67%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container d-flex align-items-center min-vh-100">
    <div class="login-container text-white p-4 w-100" style="max-width: 400px;">
      <div class="text-center mb-4">
        <img src="<?= base_url('assets/img/Admin.jpg') ?>" alt="Admin Image" style="width: 100px; height: 100px; border-radius: 50%;">
      </div>
      <h2 class="text-center mb-4">Connexion Administrateur</h2>

      <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success text-center">
          <?= session()->getFlashdata('message') ?>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div style="color:red" class="alert alert-error text-center">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form method="post" action="<?=base_url('admin/login')?>" class="form needs-validation" novalidate>
        <?=csrf_field()?>

        <!-- Email -->
        <span class="input-span">
          <label for="email" class="label">Adresse Email</label>
          <i class="fa fa-envelope icon-field"></i>
          <input type="email" class="form-control ps-5 pe-5" name="email" id="email" placeholder="Entrez votre email" required>
          <i class="fa fa-check-circle icon-check" id="email-valid-icon"></i>
          <div class="invalid-feedback">Veuillez entrer un email valide.</div>
        </span>

        <!-- Password -->
        <span class="input-span">
          <label for="mot_de_passe" class="label">Mot de Passe</label>
          <i class="fa fa-lock icon-field"></i>
          <input type="password" class="form-control ps-5 pe-5" name="mot_de_passe" id="mot_de_passe" placeholder="Entrez votre mot de passe" required>
          <i class="fa fa-eye toggle-password" id="togglePassword"></i>
          <div class="invalid-feedback">Veuillez entrer votre mot de passe.</div>
        </span>

        <span class="span"><a href="<?= base_url('admin/forgot_password');?>">Mot de Passe Oublié?</a></span>

        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-success">Se connecter</button>
        </div>
      </form>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3">
          <?=esc($error)?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    // Afficher / Cacher le mot de passe
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('mot_de_passe');

    togglePassword.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      togglePassword.classList.toggle('fa-eye');
      togglePassword.classList.toggle('fa-eye-slash');
    });

    // Vérification email format
    const emailInput = document.getElementById('email');
    const emailValidIcon = document.getElementById('email-valid-icon');

    emailInput.addEventListener('input', () => {
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (emailPattern.test(emailInput.value)) {
        emailValidIcon.style.display = 'block';
      } else {
        emailValidIcon.style.display = 'none';
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
