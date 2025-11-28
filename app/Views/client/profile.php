<?= $this->include('layout/HeaderClient') ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil Client</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="<?= base_url('assets/css/client.css') ?>">
    
    <style>
        .profile-container {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        
        .sidebar-col {
            flex: 0 0 250px;
            background-color: #2c3e50;
            color: white;
        }
        
        .main-content {
            flex: 1;
            padding: 2rem;
        }
        
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border: none;
            overflow: hidden;
        }
        
        .profile-header {
            background-color: #3498db;
            color: white;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .profile-body {
            padding: 2rem;
        }
        
        .info-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .edit-btn {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
        }
        
        .form-edit {
            display: none;
            margin-top: 1rem;
        }
        
        .btn-save {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }
        
        .btn-cancel {
            background-color: #e74c3c;
            border-color: #e74c3c;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
<div class="profile-container">
    <div class="sidebar-col">
        <?= $this->include('layout/SidebarClient') ?>
    </div>
    
    <div class="main-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="profile-card">
                    <div class="profile-header position-relative">
                        <h2><i class="bi bi-person-circle me-2"></i> Mon Profil</h2>
                        <button id="toggleEdit" class="btn btn-light btn-sm edit-btn">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </button>
                    </div>
                    
                    <div class="profile-body">
                        <form id="profileForm" action="<?= base_url('client/updateProfile') ?>" method="post">
                            <!-- Nom -->
                            <div class="info-item">
                                <div class="view-mode">
                                    <h5 class="text-muted mb-1">Nom complet</h5>
                                    <p class="fs-5"><?= esc($client['nom']) ?></p>
                                </div>
                                <div class="form-edit">
                                    <label for="nom" class="form-label">Nom complet</label>
                                    <input type="text" class="form-control" id="nom" name="nom" 
                                           value="<?= esc($client['nom']) ?>" required>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="info-item">
                                <div class="view-mode">
                                    <h5 class="text-muted mb-1">Adresse email</h5>
                                    <p class="fs-5"><?= esc($client['email']) ?></p>
                                </div>
                                <div class="form-edit">
                                    <label for="email" class="form-label">Adresse email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= esc($client['email']) ?>" required>
                                </div>
                            </div>
                            
                            <!-- Téléphone -->
                            <div class="info-item">
                                <div class="view-mode">
                                    <h5 class="text-muted mb-1">Téléphone</h5>
                                    <p class="fs-5"><?= esc($client['Telephone']) ?></p>
                                </div>
                                <div class="form-edit">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" 
                                           value="<?= esc($client['Telephone']) ?>" required>
                                </div>
                            </div>
                            
                            <!-- Boutons d'action (cachés en mode visualisation) -->
                            <div class="d-flex justify-content-end form-edit mt-4">
                                <button type="submit" class="btn btn-save">
                                    <i class="bi bi-check-circle"></i> Enregistrer
                                </button>
                                <button type="button" id="cancelEdit" class="btn btn-cancel">
                                    <i class="bi bi-x-circle"></i> Annuler
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script personnalisé -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleEdit = document.getElementById('toggleEdit');
        const cancelEdit = document.getElementById('cancelEdit');
        const viewModes = document.querySelectorAll('.view-mode');
        const formEdits = document.querySelectorAll('.form-edit');
        const profileForm = document.getElementById('profileForm');
        
        // Basculer entre mode édition et visualisation
        toggleEdit.addEventListener('click', function() {
            viewModes.forEach(mode => mode.style.display = 'none');
            formEdits.forEach(edit => edit.style.display = 'block');
            toggleEdit.style.display = 'none';
        });
        
        cancelEdit.addEventListener('click', function() {
            viewModes.forEach(mode => mode.style.display = 'block');
            formEdits.forEach(edit => edit.style.display = 'none');
            toggleEdit.style.display = 'block';
            // Réinitialiser le formulaire
            profileForm.reset();
        });
        
        // Gestion de la soumission du formulaire
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Ici vous pouvez ajouter une validation supplémentaire si nécessaire
            fetch(profileForm.action, {
                method: 'POST',
                body: new FormData(profileForm)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Afficher une notification de succès
                    alert('Profil mis à jour avec succès!');
                    location.reload();
                } else {
                    alert('Erreur: ' + (data.message || 'Une erreur est survenue'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de la mise à jour');
            });
        });
    });
</script>

</body>
</html>