<?php


namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ClientModel;
use App\Models\EmployerModel;
use App\Models\NotificationModel;
use App\Models\RendezvousModel;
use App\Models\ServiceModel;
use App\Models\NotificationClientModel;


class AdminController extends BaseController
{
    
    public function login()
    {
        if (session()->has('admin')) {
            return redirect()->to('admin/dashboard');
        }
        return view('admin/login');
    }

    public function loginPost()
    {
        $email = $this->request->getPost('email');
        $motDePasse = $this->request->getPost('mot_de_passe');

        if (empty($email) || empty($motDePasse)) {
            return redirect()->back()->withInput()->with('error', 'Tous les champs sont requis.');
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->where('email', $email)->first();

        if ($admin && password_verify($motDePasse, $admin['Mot_de_Passe'])) {
            session()->set('admin', [
                'id' => $admin['Id_Admin'],
                'nom' => $admin['Nom'],
                'email' => $admin['Email'],
            ]);
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Email ou mot de passe incorrect.');
    }

    public function dashboard()
    {
        $clientModel = new ClientModel();
        $rendezvousModel = new RendezvousModel();
        $employeModel = new EmployerModel();

        $stats = $clientModel->getDailyRegistrations();
        $dates = [];
        $totals = [];

        foreach ($stats as $row) {
            $dates[] = $row['jour'];
            $totals[] = $row['total'];
        }

        $employes = $employeModel->where('statut', 'Actif')->findAll();
        $totalRendezvous = $rendezvousModel->getTotalRendezvous();

        $data = [
            'dates' => json_encode($dates),
            'totals' => json_encode($totals),
            'employes' => $employes,
            'totalRendezvous' => $totalRendezvous,
        ];

        return view('admin/dashboard', $data);
    }
     /**
     * Affiche les notifications.
     */
    public function voirNotifications()
    {
        $notificationModel = new NotificationModel();

        $notifications = $notificationModel
            ->select("notification.*, client.nom AS nom, service.service AS service")
            ->join("client", "client.id_client = notification.id_client", "left")
            ->join("service", "service.id_service = notification.id_service", "left")
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('admin/notifications', ['notifications' => $notifications]);
    }

    /**
     * Marque une notification comme lue.
     */
    public function marquerNotificationLu($id_notification)
    {
        $notificationModel = new NotificationModel();
    
        $notif = $notificationModel->where('id_notification',$id_notification)->first();
        $notificationModel->update($id_notification, ['statut' => 'lu']);

        return redirect()->to(site_url('admin/assigner/'.$notif['id_rdv']))->with('success', 'Notification marquée comme lue.');
    }
    public function tacheAdmin()
    {
        $rendezvousModel = new RendezvousModel();
        $data['rendezvous'] = $rendezvousModel
            ->select('rendezvous.*, service.service as service_nom, client.nom as client_nom')
            ->join('service', 'service.id_service = rendezvous.id_service')
            ->join('client', 'client.id_client = rendezvous.id_client')
            ->findAll();

        return view('admin/tacheadmin', $data);
    }

    public function assigner($id_rendezvous)
    {
        $employeModel = new EmployerModel();
        $rendezvousModel = new RendezvousModel();
        $clientModel = new ClientModel();
        $serviceModel = new ServiceModel();

        $data['employes'] = $employeModel->where('statut', 'actif')->findAll();
        $data['rendezvous'] = $rendezvousModel->find($id_rendezvous);

        if (!$data['rendezvous']) {
            return redirect()->to('admin/tacheAdmin')->with('error', 'Rendez-vous non trouvé.');
        }

        $client = $clientModel->find($data['rendezvous']['id_client']);
        $service = $serviceModel->find($data['rendezvous']['id_service']);

        $data['client_nom'] = $client['nom'];
        $data['service_nom'] = $service['service'];

        $rendezvousForCalendar = $rendezvousModel->findAll();

        $events = [];
        foreach ($rendezvousForCalendar as $rdv) {
            $clientForEvent = $clientModel->find($rdv['id_client']);
            $serviceForEvent = $serviceModel->find($rdv['id_service']);

            $events[] = [
                'title' => "Rendez-vous avec " . esc($clientForEvent['nom']) . " (" . esc($serviceForEvent['service']) . ")",
                'start' => $rdv['date_rdv'] . 'T' . $rdv['heure_debut'],
                'end' => $rdv['date_rdv'] . 'T' . (isset($rdv['heure_fin']) ? $rdv['heure_fin'] : '23:59'),
                'description' => 'Service: ' . esc($serviceForEvent['service']),
            ];
        }

        $data['events'] = json_encode($events);

        return view('admin/assigner', $data);
    }
    public function assignerEmploye()
    {
        $rendezvousModel = new RendezvousModel();
        $id_rendezvous = $this->request->getPost('id_rendezvous');
        $rendezvousModel = new RendezvousModel();
        $rendez_vous = $rendezvousModel->find($id_rendezvous);
        $id_employe = $this->request->getPost('id_employer');
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($rendez_vous['id_service']);
        if ($id_rendezvous && $id_employe) {
            $data = [
                'id_employer' => $id_employe,
                'status' => 'Validé',
            ];

            $notification_client = new NotificationClientModel();
            $id_rdv = $rendez_vous['id_rendezVous'];
            $array_notif_client = array(
                "id_client" => $rendez_vous['id_client'],
                'message' => 'Rendez-vous en '.$service['service'].' de la date ('.$rendez_vous['date_rdv'].' à '.$rendez_vous['heure_debut'].' ) a été validé',
                "date_notification" => date('Y-m-d H:i:s'),
                "statut" => 'non_lue',
                "id_rdv" => $id_rdv,
            );

            $notification_client->insert($array_notif_client);

            if ($rendezvousModel->update($id_rendezvous, $data)) {
                return redirect()->to(base_url('admin/tacheAdmin'))->with('success', 'Employé assigné avec succès.');
            } else {

                return redirect()->back()->with('error', 'Échec de l\'assignation.');
            }
        }

        return redirect()->back()->with('error', 'Données invalides.');
    }

    public function refuserRendezVous()
    {
        $json = $this->request->getJSON();
        $id_rendezvous = $json->id_rendezvous;
        
        if (!$id_rendezvous) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID de rendez-vous invalide',
            ]);
        }

        $rendezvousModel = new RendezvousModel();
        $rendez_vous = $rendezvousModel->find($id_rendezvous);
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($rendez_vous['id_service']);
        try {
            $rendezvousModel->update($id_rendezvous, [
                'status' => 'Refusé',
                'id_employe' => null,
            ]);
            $id_rdv = $rendez_vous['id_rendezVous'];
            $notification_client = new NotificationClientModel();

            $array_notif_client = array(
                "id_client" => $rendez_vous['id_client'],
                'message' => 'Rendez-vous en '.$service['service'].' de la date ('.$rendez_vous['date_rdv'].' à '.$rendez_vous['heure_debut'].') a été refusé avec succès',
                "date_notification" => date('Y-m-d H:i:s'),
                "statut" => 'non_lue',
                "id_rdv" => $id_rdv,
            );

            $notification_client->insert($array_notif_client);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Rendez-vous en '.$service['service'].' de la date du '.$rendez_vous['date_rdv'].' à '.$rendez_vous['heure_debut'].' a été refusé avec succès',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage(),
            ]);
        }
    }
// Dans app/Controllers/AdminController.php
    public function logout()
    {
        $session = session();

        // 1. Vérifier si une session existe avant toute opération
        if ($session->has('admin')) {
            // 2. Régénération de l'ID AVANT destruction (session active)
            session_regenerate_id(true);

            // 3. Destruction complète des données
            $session->remove(['user_id', 'username', 'logged_in','admin']);
            $session->destroy();
        }

        // 4. Nettoyage des cookies
        helper('cookie');
        delete_cookie(session_name());

        // 5. Headers anti-cache
        $response = service('response');
        $response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->setHeader('Pragma', 'no-cache');
        $response->setHeader('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

        // Méthode CORRECTE avec redirect()
        return redirect()->to(base_url('admin/login'))
            ->with('message', 'Déconnexion réussie');
    }

    public function getRendezVous(){
        $rendezvousModel = new RendezVousModel(); // Correction du nom de la classe (casse importante)
        $date_to_get = $this->request->getPost('date');
        
        $allRendezVous = $rendezvousModel
            ->select('rendezvous.*, employe.nom as employe_nom, client.nom as client_nom') // Sélection explicite
            ->join('employe', 'employe.id_employer  = rendezvous.id_employer', 'left') // Correction des noms de colonnes
            ->join('client', 'client.id_client = rendezvous.id_client', 'left') // Correction de la jointure client
            ->where('date_rdv', $date_to_get)
            ->findAll();
            if ($allRendezVous != null) {
                return $this->response->setJSON($allRendezVous); // Meilleure pratique pour retourner JSON
            }else{
                return $this->response->setJSON([]); // Meilleure pratique pour retourner JSON

            }
    }
    public function validerRendezvous($id_rendezvous)
{
    // Chargement des modèles
    $rdvModel = new \App\Models\RendezvousModel();
    $clientModel = new \App\Models\ClientModel();
    $notifModel = new \App\Models\NotificationClientModel();

    // Récupération du rendez-vous
    $rdv = $rdvModel->find($id_rendezvous);

    if ($rdv) {
        // Mise à jour du statut du rendez-vous
        $rdvModel->update($id_rendezvous, ['statut' => 'validé']);

        // Création d’un message personnalisé
        $message = "Bonjour, votre rendez-vous du " . $rdv['date_rdv'] . 
                   " à " . $rdv['heure_debut'] . " a été confirmé avec l’employé : " . $rdv['nom_employe'];

        // Ajout d'une notification client
        $notifModel->insert([
            'id_client' => $rdv['id_client'],
            'message' => $message
        ]);

        return redirect()->back()->with('success', 'Rendez-vous validé et notification envoyée');
    } else {
        return redirect()->back()->with('error', 'Rendez-vous introuvable');
    }
}
    public function forgot_password(){
        $data['reset_url'] = null;
        return view('admin/forgot_password',$data);
    }

    public function send_reset_passwor_mail(){
        $mail = $this->request->getPost('email');
        $adminModel = new AdminModel();
        $user = $adminModel->where('Email',$mail)->first();
        if($user != null){
            $token = bin2hex(random_bytes(16));
            $data_update = array(
                "reset_password_token" => $token,
                "reset_password_datetime" =>  date('Y-m-d H:i:s')
            );
            $adminModel->update($user['Id_Admin'],$data_update);
            $data['reset_url'] = base_url("admin/reset_password_confirm/".$token);
            return view('admin/forgot_password',$data);
        }else{
            $data['error'] = true;
            return view('admin/forgot_password/',$data);
        }
    }

    public function reset_password_confirm($token){
        $adminModel = new AdminModel();
        $user = $adminModel->where('reset_password_token',$token)->first();
        $data['user'] = $user;
        return view('admin/reset_password_page_new',$data);
    }

    public function change_password(){
        $password = $this->request->getPost('password');
        $token = $this->request->getPost('token');
        $adminModel = new AdminModel();
        $user = $adminModel->where('reset_password_token',$token)->first();
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $adminModel = new AdminModel();
        $data['Mot_de_Passe'] = $hashed_pass;
        $adminModel->update($user['Id_Admin'],$data);
        return redirect()->to(base_url('admin/login'))
            ->with('message', 'Mot de passe changé');
    }

}
