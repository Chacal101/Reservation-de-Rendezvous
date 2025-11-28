<?php

namespace App\Controllers;

use App\Models\EmployerModel;
use CodeIgniter\Controller;

class EmployerController extends Controller
{
    public function index()
    {
        $model = new EmployerModel();
        $data['employe'] = $model->findAll();
        
        return view('admin/Employer', $data);
    }

    public function store()
    {
        $model = new EmployerModel();
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nom' => 'required|min_length[3]',
            'email' => 'required',
            'statut' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('errors', $validation->getErrors());
        }

        $model->save([
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'statut' => $this->request->getPost('statut'),
        ]);

        return redirect()->to('/employes')->with('success', 'Employé ajouté avec succès');
    }

    public function delete($id)
    {
        $model = new EmployerModel();
        $model->delete($id);
        
        return redirect()->to('/employes')->with('success', 'Employé supprimé');
    }
}
