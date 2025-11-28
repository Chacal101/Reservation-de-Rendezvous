<?php

namespace App\Models;

use CodeIgniter\Model;

class RendezvousModel extends Model
{
    protected $table = 'rendezvous'; // Nom de la table
    protected $primaryKey = 'id_rendezvous'; // Clé primaire
    protected $allowedFields = ['date_rdv', 'heure_debut', 'heure_fin', 'id_service', 'id_client', 'id_employer', 'status']; // Ajout des nouveaux champs

    // Activer l'ajout automatique de timestamps (si la table a `created_at` et `updated_at`)
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // ✅ Correction de la méthode `getRendezvousLus()`
    public function getRendezvousLus()
    {
        return $this->where('status', 'En attente')->findAll();
    }

    // ✅ Correction de la méthode `assignerEmploye()`
    public function assignerEmploye($id_rendezvous, $id_employe)
    {
        return $this->update($id_rendezvous, [
            'id_employe' => $id_employe,
            'status' => 'Validé'
        ]);
    }

    // ✅ Ajout de la méthode `getTotalRendezvous()` pour éviter l'erreur dans `AdminController`
    public function getTotalRendezvous()
    {
        return $this->countAll();
    }
    
}
