<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RendezvousModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $rendezvousModel = new RendezvousModel();
        $totalRendezvous = $rendezvousModel->getTotalRendezvous();
        // Initialisation des modèles
        $rdvModel = new RendezvousModel();
        $employeModel = new EmployerModel();
        $serviceModel = new ServiceModel();
        $notifModel = new NotificationModel();

        // 1. Statistiques de base
        $totalRendezvous = $rdvModel->countAll();
        $rdvConfirmes = $rdvModel->where('status', 'confirmé')->countAllResults();
        $rdvEnAttente = $rdvModel->where('status', 'en attente')->countAllResults();
        $rdvAnnules = $rdvModel->where('status', 'annulé')->countAllResults();
        
        // 2. Calcul des pourcentages
        $tauxCompletion = ($totalRendezvous > 0) ? round(($rdvConfirmes / $totalRendezvous) * 100) : 0;
        
        // 3. Service le plus demandé
        $topService = $serviceModel->getMostPopularService();
        $rdvTopService = $rdvModel->where('id_service', $topService['id_service'] ?? null)->countAllResults();
        
        // 4. Statistiques hebdomadaires
        $semaineLabels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        $semaineData = [];
        
        foreach ($semaineLabels as $day) {
            // Implémentez votre logique pour récupérer les RDV par jour
            $semaineData[] = $rdvModel->getCountByDay($day); 
        }
        
        // 5. Répartition par employé
        $employes = $employeModel->findAll();
        $employesNoms = [];
        $employesRdvs = [];
        
        foreach ($employes as $emp) {
            $employesNoms[] = $emp['nom'];
            $employesRdvs[] = $rdvModel->where('id_employe', $emp['id_employe'])->countAllResults();
        }
        
        // 6. Services demandés
        $services = $serviceModel->findAll();
        $servicesLabels = [];
        $servicesData = [];
        
        foreach ($services as $serv) {
            $servicesLabels[] = $serv['service'];
            $servicesData[] = $rdvModel->where('id_service', $serv['id_service'])->countAllResults();
        }
        
        // 7. Évolution mensuelle (exemple simplifié)
        $currentMonth = date('m');
        $lastMonth = date('m', strtotime('-1 month'));
        $currentCount = $rdvModel->where('MONTH(date_rdv)', $currentMonth)->countAllResults();
        $lastCount = $rdvModel->where('MONTH(date_rdv)', $lastMonth)->countAllResults();
        
        $evolutionMois = ($lastCount > 0) 
            ? round((($currentCount - $lastCount) / $lastCount) * 100) 
            : 100;

        // 8. Notifications non lues
        $nbNonLues = $notifModel->where('statut', 'non lu')->countAllResults();

        // Préparation des données pour la vue
        $data = [
            // Statistiques de base
            'totalRendezvous' => $totalRendezvous,
            'rdvConfirmes' => $rdvConfirmes,
            'rdvEnAttente' => $rdvEnAttente,
            'rdvAnnules' => $rdvAnnules,
            'tauxCompletion' => $tauxCompletion,
            
            // Services
            'topService' => $topService['service'] ?? 'Aucun',
            'rdvTopService' => $rdvTopService,
            
            // Graphiques
            'semaineLabels' => $semaineLabels,
            'semaineData' => $semaineData,
            'employesNoms' => $employesNoms,
            'employesRdvs' => $employesRdvs,
            'servicesLabels' => $servicesLabels,
            'servicesData' => $servicesData,
            
            // Évolution
            'evolutionMois' => $evolutionMois,
            
            // Notifications
            'nbNonLues' => $nbNonLues,
            
            // Données existantes
            'employes' => $employes
        ];

        return view('admin/dashboard', ['totalRendezvous' => $totalRendezvous]);
    }
    
}
