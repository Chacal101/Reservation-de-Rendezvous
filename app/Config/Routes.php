<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Page d'accueil
$routes->get('/', 'Home::index');
$routes->get('login', 'Home::index');

// Routes pour l'administration
$routes->group('admin', ['filter' => 'auth'],function ($routes) {

    $routes->get('register', 'AdminController::register'); // Afficher la page d'inscription
    $routes->post('register', 'AdminController::registerPost'); // Traiter l'inscription

    $routes->get('dashboard', 'AdminController::dashboard'); // Tableau de bord Admin
    $routes->get('tacheadmin', 'AdminController::tacheAdmin'); //Voir RDV   
    $routes->match(['get', 'post'], 'logout', 'AdminController::logout');
    $routes->get('marquer_lu/(:num)', 'AdminController::marquerNotificationLu/$1'); // Marquer notif comme lue
    $routes->get('tacheAdmin', 'AdminController::tacheAdmin');
    $routes->get('assigner/(:num)', 'AdminController::assigner/$1');
    $routes->post('assignerEmploye', 'AdminController::assignerEmploye');
    $routes->post('refuserRendezVous', 'AdminController::refuserRendezVous');
    $routes->get('notifications', 'AdminController::voirNotifications'); // Voir les notifications   
    $routes->post('rendezvous_events', 'AdminController::getRendezVous'); // Soumettre RDV


});
// Groupe de routes protégées par le filtre 'auth' (nécessite une session active)
$routes->group('admin', function ($routes) { 
    $routes->get('login', 'AdminController::login'); // Afficher la page de connexion
    $routes->post('login', 'AdminController::loginPost'); // Traiter la connexion
    $routes->get('forgot_password', 'AdminController::forgot_password');
    $routes->post('send_reset_passwor_mail', 'AdminController::send_reset_passwor_mail');
    $routes->post('reset_password_page_new', 'AdminController::send_reset_passwor_mail');
    $routes->get('reset_password_confirm/(:any)', 'AdminController::reset_password_confirm/$1');
    $routes->post('change_password', 'AdminController::change_password');

});
// Routes pour les Services
$routes->get('/services', 'ServiceController::index');
$routes->post('/services/store', 'ServiceController::store');

// Route Calendar
$routes->get('/calendar_view', 'CalendarController::index');
$routes->get('calendar/getEvents', 'CalendarController::getEvents');

// Routes Employés
$routes->get('/employes', 'EmployerController::index');
$routes->post('/employes/store', 'EmployerController::store');
$routes->get('/employes/edit/1', 'EmployerController::index');
$routes->get('/employes/delete/(:num)', 'EmployerController::delete/$1');

// Routes pour les Clients
$routes->group('client', function ($routes) {
    $routes->get('/', 'ClientController::index'); // Page d'accueil
    $routes->get('vitrine', 'ClientController::vitrine'); // Page vitrine
    $routes->get('login', 'AuthController::login'); // Connexion
    $routes->get('logout', 'ClientController::logout'); // Déconnexion
    $routes->get('services', 'ClientController::services'); // Liste des services
    $routes->get('mes_rendezvous', 'ClientController::mesRendezvous'); // Mes RDVs
    $routes->get('recherche', 'ClientController::recherche'); // Recherche
    $routes->get('profile', 'ClientController::profil'); // Profil
    $routes->get('prendreRendezVous/(:num)', 'ClientController::prendreRendezVous/$1'); // Prendre RDV
    $routes->post('soumettreRendezVous', 'ClientController::soumettreRendezVous'); // Soumettre RDV
    $routes->post('getAllRdvByService', 'ClientController::getAllRdvByService');
    $routes->post('updateProfile', 'ClientController::updateProfile');
});

// Routes pour l'authentification
$routes->group('auth', function ($routes) {
    $routes->get('login', 'AuthController::login'); // Page de connexion
    $routes->post('processLogin', 'AuthController::processLogin'); // Traitement connexion
    $routes->get('logout', 'AuthController::logout'); // Déconnexion
    $routes->get('register', 'AuthController::register'); // Page d'inscription
    $routes->post('processRegister', 'AuthController::processRegister'); // Traitement 
});
//Route Calendrier
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('calendar_view', 'RendezvousController::calendrier'); // /admin/calendrier
});
$routes->get('client/notification', 'ClientController::mesNotifications');
$routes->get('client/notification/lue/(:num)', 'ClientController::marquerCommeLue/$1');

