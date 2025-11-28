<?php

// Vérifier si CodeIgniter est installé
if (!function_exists('password_hash')) {
    die("La fonction password_hash() n'est pas disponible.");
}

// Définir le mot de passe à hacher
$password = "test123"; // Change ce mot de passe

// Générer le hash avec bcrypt
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Afficher le hash
echo "Mot de passe haché : " . $hashed_password;

?>
