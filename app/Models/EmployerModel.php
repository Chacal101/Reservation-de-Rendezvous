<?php

namespace App\Models; // Le bon namespace ici

use CodeIgniter\Model;

class EmployerModel extends Model
{
    protected $table = 'employe'; // Nom de la table
    protected $primaryKey = 'id_employer'; // Clé primaire
    protected $allowedFields = ['nom','email', 'statut']; // Champs autorisés
    //protected $useTimestamps = true; // Si tu utilises des timestamps
     // Récupérer les employés actifs
     public function getEmployesActifs()
     {
         return $this->where('statut', 'Actif')->findAll();
     }
     public function getEmployesLibres($date, $heure)
{
    $this->db->select('*');
    $this->db->from('employes');
    $this->db->where("id NOT IN (SELECT id_employe FROM rendezvous WHERE date_rdv = ? AND heure_debut = ?)", [$date, $heure]);
    $query = $this->db->get();
    return $query->result();
}

}
