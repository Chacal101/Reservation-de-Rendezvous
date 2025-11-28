<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row"style="padding-top: 7rem;">
        <!-- Tableau des employés -->
        <div class="col-md-8">
            <div class="card p-3">
                <h3 class="text-center">Liste des Employés</h3>
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                   
                            <th>Nom</th>
                            <th>Statut</th>
                            <th>E-Mail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employe as $employe): ?>
                            <tr>
                                <td><?= esc($employe['nom']) ?></td>
                                <td>
                                    <span class="badge <?= ($employe['statut'] === 'Actif') ? 'bg-success' : 'bg-danger' ?>">
                                        <?= esc($employe['statut']) ?>
                                    </span>
                                </td>
                                <td><?= esc($employe['email']) ?></td>
                                <td>
                                    <a href="<?= base_url('employes/edit/'.$employe['id_employer']) ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('employes/delete/'.$employe['id_employer']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?')">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Formulaire d'ajout -->
        <div class="col-md-4">
            <div class="card p-4">
                <h3 class="text-center">Ajouter un Employé</h3>
                
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <p><?= esc($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('employes/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de l'Employé</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Annuler</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
