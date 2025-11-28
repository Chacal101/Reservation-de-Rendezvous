<?php

namespace App\Controllers;

use App\Models\RendezvousModel;
use App\Models\EmployerModel;
use App\Models\ClientModel;
use App\Models\ServiceModel;
use CodeIgniter\Controller;

class RendezvousController extends Controller
{
    public function index()
    {
        return $this->calendrier();
    }

    public function calendrier()
{
    $rendezvousModel = new RendezvousModel();
    $clientModel = new ClientModel();
    $serviceModel = new ServiceModel();
    $employeModel = new EmployerModel();

    $rendezvous = $rendezvousModel
        ->select('rendezvous.*, clients.nom as client_nom, services.service as service_nom, employes.nom as employe_nom')
        ->join('clients', 'clients.id_client = rendezvous.id_client')
        ->join('services', 'services.id_service = rendezvous.id_service')
        ->join('employes', 'employes.id_employe = rendezvous.id_employe', 'left')
        ->findAll();

    $events = [];
    foreach ($rendezvous as $rdv) {
        $events[] = [
            'title' => 'RDV ' . $rdv['client_nom'],
            'start' => $rdv['date_rdv'] . 'T' . $rdv['heure_debut'],
            'end' => $rdv['date_rdv'] . 'T' . ($rdv['heure_fin'] ?? $rdv['heure_debut']),
            'status' => $rdv['status'] ?? 'En attente',
            'client' => $rdv['client_nom'],
            'service' => $rdv['service_nom'],
            'heure' => $rdv['heure_debut'],
            'employe' => $rdv['employe_nom'] ?? 'Non assigné',
            'color' => $this->getStatusColor($rdv['status'] ?? 'En attente')
        ];
    }

    return view('admin/calendar_view', ['events' => $events]);
}

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'Validé':
            case 'Accepté':
                return '#28a745'; // Vert
            case 'En attente':
                return '#ffc107'; // Jaune
            case 'Refusé':
                return '#dc3545'; // Rouge
            default:
                return '#6c757d'; // Gris par défaut
        }
    }

    public function assigner()
    {
        $rendezvousModel = new RendezvousModel();

        $id_rendezvous = $this->request->getPost('id_rendezvous');
        $id_employe = $this->request->getPost('id_employe');

        if ($id_rendezvous && $id_employe) {
            $data = [
                'id_employe' => $id_employe,
                'status' => 'Accepté'
            ];
            
            $rendezvousModel->update($id_rendezvous, $data);
            return redirect()->to('/rendezvous/calendrier')->with('success', 'Rendez-vous assigné avec succès !');
        }

        return redirect()->to('/rendezvous/calendrier')->with('error', 'Une erreur est survenue.');
    }

    public function nonAssignes()
    {
        $rendezvousModel = new RendezvousModel();
        $employeModel = new EmployerModel();

        // Récupérer les rendez-vous non assignés
        $rendezvous = $rendezvousModel
            ->select('rendezvous.*, clients.nom as client_nom, services.service as service_nom')
            ->join('clients', 'clients.id_client = rendezvous.id_client')
            ->join('services', 'services.id_service = rendezvous.id_service')
            ->where('id_employe', null)
            ->findAll();

        // Récupérer les employés actifs
        $employes = $employeModel->where('statut', 'Actif')->findAll();

        // Envoyer les données à la vue
        return view('rendezvous/non_assignes', [
            'rendezvous' => $rendezvous,
            'employes' => $employes
        ]);
    }
}