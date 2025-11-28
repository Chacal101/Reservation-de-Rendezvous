<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/react@18.0.0/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@18.0.0/umd/react-dom.production.min.js"></script>
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
        .container{
            justify-content: left !important;
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
        }

        .form input[type="email"],
        .form input[type="password"] {
            border-radius: 0.5rem;
            padding: 1rem 0.75rem;
            width: 100%;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--clr-alpha);
            outline: 2px solid var(--bg-dark);
        }

        .form input[type="email"]:focus,
        .form input[type="password"]:focus {
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 3rem;
            background-color: var(--bg-dark);
            color: var(--bg-light);
            border: none;
            cursor: pointer;
            transition: all 300ms;
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
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container text-white p-4 w-100" style="max-width: 400px;">
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/img/Admin.jpg') ?>" alt="Admin Image" style="width: 100px; height: 100px; border-radius: 50%;">
        </div>
        <h2 class="text-center mb-4">Réinitialiser mot de passe : <?= $user['Nom'] ?></h2>
        <form  method="post" action="<?=base_url('admin/change_password')?>" id="resetForm" onsubmit="return checkPasswordsMatch();">
            <input name="token" type="hidden" value="<?= $user['reset_password_token'] ?>">
            <span class="input-span">
                    <label for="password" class="label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Entrez le nouveau mot de passe" required>
                </span>
                        <span class="input-span">
                    <label for="confirm_password" class="label">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Entrez à nouveau le nouveau mot de passe" required>
                </span>

            <div id="error-message" class="text-danger text-center my-2" style="display: none;"></div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Réinitialiser mot de passe</button>
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
    function checkPasswordsMatch() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const errorDiv = document.getElementById("error-message");

        if (password !== confirmPassword) {
            errorDiv.textContent = "Les mots de passe ne correspondent pas.";
            errorDiv.style.display = "block";
            return false; // empêche la soumission
        }

        errorDiv.style.display = "none"; // tout est ok
        return true;
    }
</script>
<div id="login-react"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
