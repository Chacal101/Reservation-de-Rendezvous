<?php

namespace App\Controllers;

use App\Models\ClientModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('client/login');
    }

    public function processLogin()
    {
        $clientModel = new ClientModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $client = $clientModel->where('email', $email)->first();

        if ($client && password_verify($password, $client['password'])) {
            session()->set([
                'client_id' => $client['id'],
                'client_nom' => $client['nom']
            ]);
            return redirect()->to('/client')->with('success', 'Connexion réussie.');
        } else {
            return redirect()->to('/client/login')->with('error', 'Identifiants incorrects.');
        }
    }

    public function register()
    {
        return view('client/register');
    }

    public function processRegister()
    {
        $clientModel = new ClientModel();
        $data = [
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $clientModel->insert($data);
        return redirect()->to('/client/login')->with('success', 'Compte créé avec succès.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/client/login')->with('success', 'Déconnexion réussie.');
    }
}
