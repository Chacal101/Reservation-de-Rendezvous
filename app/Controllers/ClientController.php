<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\RendezvousModel;
use App\Models\ClientModel;
use CodeIgniter\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return $this->vitrine();
    }

    // ✅ Ajout de la méthode vitrine()
    public function vitrine()
    {
        $perPage = 6; // Nombre d’éléments par page
        $serviceModel = new ServiceModel();
    
        // Utilise uniquement la pagination
        $data['services'] = $serviceModel->paginate($perPage);
        $data['pager'] = $serviceModel->pager;
    
        return view('layout/vitrine', $data);
    }
    

    public function prendreRendezVous($id_service)
    {
        if (!session()->has('client_id')) {
            return redirect()->to(site_url('client/login'))->with('error', 'Vous devez être connecté pour prendre un rendez-vous.');
        }

        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($id_service);

        if (!$service) {
            return redirect()->to(site_url('client/vitrine'))->with('error', 'Service non trouvé.');
        }

        $data = [
            'service' => $service,
            'client_nom' => session()->get('client_nom'),
        ];

        return view('client/form_rdv', $data);
    }

    public function soumettreRendezVous()
    {
        if (!session()->has('client_id')) {
            return redirect()->to(site_url('client/login'))->with('error', 'Vous devez être connecté pour prendre un rendez-vous.');
        }

        $rendezvousModel = new RendezvousModel();
        $notificationModel = new \App\Models\NotificationModel();

        $client_id = session()->get('client_id');
        $service_id = $this->request->getPost('service_id');
        $date_rdv = $this->request->getPost('date_rdv');
        $heure_debut = $this->request->getPost('heure_debut');

        $rendezvousData = [
            'id_client' => $client_id,
            'id_service' => $service_id,
            'date_rdv' => $date_rdv,
            'heure_debut' => $heure_debut,
        ];

        if ($rendezvousModel->insert($rendezvousData)) {
            $id_rdv	= $rendezvousModel->getInsertID();
            $notificationData = [
                'id_client' => $client_id,
                'id_service' => $service_id,
                'date_rdv' => $date_rdv,
                'heure_debut' => $heure_debut,
                'statut' => 'non lu',
                'id_rdv' => $id_rdv,
            ];

            $notificationModel->insert($notificationData);

            return redirect()->to(site_url('client/mes_rendezvous'))->with('success', 'Votre rendez-vous a été enregistré.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la prise de rendez-vous.');
        }
    }

    public function login()
    {
        return view('client/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('client/login'))->with('success', 'Déconnexion réussie.');
    }

    public function services()
    {
        return redirect()->to(site_url('client/vitrine'));
    }

    public function mesRendezvous()
    {
        if (!session()->has('client_id')) {
            return redirect()->to(site_url('client/login'))->with('error', 'Vous devez être connecté pour voir vos rendez-vous.');
        }
    
        $rendezvousModel = new RendezvousModel();
        $client_id = session()->get('client_id');
    
        $data['rendezvous'] = $rendezvousModel
            ->select('rendezvous.*, service.service as service_nom')
            ->join('service', 'service.id_service = rendezvous.id_service')
            ->where('rendezvous.id_client', $client_id)
            ->findAll();
    
        return view('client/mes_rendezvous', $data);
    }

    public function recherche()
    {
        $serviceModel = new ServiceModel();
        $query = $this->request->getGet('q');

        $services = $query ? $serviceModel->like('service', $query)->findAll() : $serviceModel->findAll();

        return view('layout/vitrine', ['services' => $services]);
    }

    public function verifierDisponibilite()
    {
        $date = $this->request->getGet('date');
        $heure = $this->request->getGet('heure');

        $rendezvousModel = new RendezvousModel();
        $dejaPris = $rendezvousModel
                    ->where('date_rdv', $date)
                    ->where('heure_debut <=', $heure)
                    ->where('heure_fin >', $heure)
                    ->countAllResults();

        return $this->response->setJSON(['disponible' => $dejaPris == 0]);
    }

    public function profil()
    {
        $session = session();
        $clientId = $session->get('client_id');

        if (!$clientId) {
            return redirect()->to('/login');
        }

        $clientModel = new ClientModel();
        $client = $clientModel->find($clientId);

        return view('client/profile', ['client' => $client]);
    }
    public function mesNotifications()
{
    $notifModel = new \App\Models\NotificationClientModel();
    $id_client = session()->get('client_id');

    $notifications = $notifModel
    ->select('notifications_client.*, rendezvous.*')
    ->where('notifications_client.id_client', $id_client)
    ->join('rendezvous', 'rendezvous.id_rendezVous = notifications_client.id_rdv', 'left') // join sur id_rdv
    ->orderBy('date_notification', 'DESC')
    ->groupBy('notifications_client.id_notification') // groupement par notification
    ->findAll();
    return view('client/notification', ['notifications' => $notifications]);
}

public function getAllRdvByService(){
    $date = $this->request->getPost("date");
    $id_service = $this->request->getPost("service");
    $rendezvousModel = new RendezvousModel();
    $rdv = $rendezvousModel
        ->where('date_rdv',$date)
        ->where('id_service',$id_service)->findAll();
    return $this->response->setJSON($rdv);
}

public function updateProfile(){
    $nom = $this->request->getPost('nom') ?? null;
    $email = $this->request->getPost('email') ?? null;
    $telephone = $this->request->getPost('telephone') ?? null;
    $array_user = [];
    if($nom != null){
        $array_user['nom'] = $nom;
    }
    if($email != null){
        $array_user['email'] = $email;
    }
    if($telephone != null){
        $array_user['Telephone'] = $telephone;
    }

    if($array_user != []){
        $clientModel = new ClientModel();
        $client_id = session()->get('client_id');
        $clientModel->update($client_id,$array_user);
        return $this->response->setJSON([
            'status' => 'success',
        ]);
        
    }
}

}
