    <?= $this->extend('layout/main') ?>
    <?= $this->section('content') ?>
    <style>
        body {
            background-color: #e3f2fd;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #2196F3;
            border-color: #2196F3;
        }
        .btn-primary:hover {
            background-color: #1976D2;
        }
        h3 {
            color: #1565C0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row"style="padding-top: 7.1rem;">
            <!-- Liste des services -->
            <div class="col-lg-8 col-md-7 mb-3">
                <div class="card p-3">
                    <h3 class="text-center">Liste des Services</h3>
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nom du Service</th>
                                    <th>Description</th>
                                    <th>Durée (Jours)</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($services as $service): ?>
                                    <tr>   
                                        <td><?= esc($service['service']) ?></td>
                                        <td><?= esc($service['description']) ?></td>
                                        <td><?= esc($service['durée']) ?></td>
                                        <td><?= esc($service['Prix']) ?> Ar</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Formulaire d'ajout de service -->
            <div class="col-lg-4 col-md-5">
                <div class="card p-4">
                    <h3 class="text-center">Ajouter un Service</h3>
                    
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/services/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="service" class="form-label">Nom du Service</label>
                            <input type="text" class="form-control" id="service" name="service" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="durée" class="form-label">Durée (Jours)</label>
                            <input type="number" class="form-control" id="durée" name="durée" required>
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (Ar)</label>
                            <input type="number" step="100" class="form-control" id="prix" name="prix" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Annuler</button>
                            <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-warning"><i class="fa-solid fa-right-from-bracket"></i> Retour</a>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?= $this->endSection() ?>
