<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'administrateur'; // Nom de la table en base de données
    protected $primaryKey = 'Id_Admin';       // Clé primaire

    protected $allowedFields = ['Nom', 'Email', 'Mot_de_Passe','reset_password_token','reset_password_datetime'];

    // Activation des timestamps si les colonnes created_at et updated_at existent
    // protected $useTimestamps = true;
}
