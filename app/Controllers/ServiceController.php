<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use CodeIgniter\Controller;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->serviceModel = new ServiceModel(); // Charger le modèle
    }

    // Afficher tous les services
    public function index()
    {
        // Récupérer tous les services de la base
        $data['services'] = $this->serviceModel->getAllServices();

        // Afficher la vue avec les services
        return view('admin/service', $data);

        //recuperation de nombre
        $model = new ServiceModel(); 
        $total = $model->countAll(); // Récupère le nombre total d'enregistrements

        // Envoie la variable $total à la vue
        return view('admin/dashboard', ['total' => $total]);
    }

    // Ajouter un nouveau service
    public function store()
    {
        // Récupérer les données du formulaire
        $serviceData = $this->request->getPost();

        // Validation des données
        if (!$this->validate([
            'service' => 'required|string|max_length[255]',
            'description' => 'permit_empty|string|max_length[255]',
            'durée' => 'required|numeric',
            'prix' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $array_service = [
            'service' => $serviceData['service'],
            'description' => $serviceData['description'],
            'durée' => $serviceData['durée'],
            'Prix' => $serviceData['prix']
        ];
        // var_dump($array_service);die();
        // Insertion dans la base de données
        $this->serviceModel->insert($array_service);

        // Rediriger vers la page des services avec un message de succès
        return redirect()->to('/services')->with('success', 'Service ajouté avec succès!');
    }
}