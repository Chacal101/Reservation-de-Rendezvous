<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'client'; // ✅ Nom de la table
    protected $primaryKey = 'id_client'; // ✅ Clé primaire correcte
    protected $allowedFields = ['nom', 'email', 'password', 'Telephone', 'date_creation']; // ✅ Champs autorisés

    // ✅ Fonction pour récupérer les inscriptions par jour
    public function getDailyRegistrations()
    {
        return $this->select("DATE(date_creation) as jour, COUNT(id_client) as total")
                    ->groupBy('jour')
                    ->orderBy('jour', 'ASC')
                    ->findAll();
    }
}
