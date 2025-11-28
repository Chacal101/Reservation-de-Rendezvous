<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'service'; // Nom de la table
    protected $primaryKey = 'id_service'; // Clé primaire

    // Champs accessibles en insertion ou mise à jour
    protected $allowedFields = [
        'service', // Nom du service
        'description', // Description du service
        'durée', // Durée
        'Prix', // Prix
    ];

    // Activer les timestamps si tu as des colonnes created_at et updated_at
    //protected $useTimestamps = true;

    // Valider les données avant insertion/mise à jour
    protected $validationRules = [
        'service' => 'required|string|max_length[255]',
        'description' => 'permit_empty|string|max_length[255]',
        'durée' => 'required|numeric',
        'Prix' => 'required|numeric',
    ];

    protected $validationMessages = [
        'service' => [
            'required' => 'Le nom du service est obligatoire.',
            'max_length' => 'Le nom du service ne peut pas dépasser 255 caractères.',
        ],
        'durée' => [
            'required' => 'La durée est obligatoire.',
            'valid_date' => 'La durée doit être une date valide.',
        ],
        'Prix' => [
            'required' => 'Le prix est obligatoire.',
            'numeric' => 'Le prix doit être un nombre valide.',
        ],
    ];

    // Fonction pour récupérer tous les services
    public function getAllServices()
    {
        return $this->findAll(); // Récupère tous les services
    }

    // Fonction pour récupérer un service par ID
    public function getServiceById($id)
    {
        return $this->find($id); // Trouve un service par son ID
    }
    
}