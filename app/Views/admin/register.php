<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Administrateur</title>
</head>
<body>
    <h1>Inscription Administrateur</h1>
    <form action="<?= base_url('admin/register') ?>" method="post">
        <?= csrf_field() ?>
        <input type="text" name="nom" placeholder="Nom" value="<?= old('nom') ?>" required><br>
        <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required><br>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
        <button type="submit">S'inscrire</button>
    </form>
    <?php if (session()->has('errors')) : ?>
        <div>
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>
