<?=$this->extend('layout/main')?>

<?=$this->section('content')?>

<div class="container-fluid py-4" style="max-width: 95%;" id="TacheA">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="h5 mb-0 text-center">Liste des Rendez-vous</h2>
        </div>
        
        <div class="card-body">
            <!-- Barre de recherche améliorée -->
            <div class="row mb-4 g-3 align-items-center">
                <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="searchNom" class="form-control form-control-lg" placeholder="Rechercher par nom client...">
                        <button id="btnSearch" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Rechercher
                        </button>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <select id="filterStatus" class="form-select form-select-lg">
                        <option value="">Tous les statuts</option>
                        <option value="Confirmé">Confirmé</option>
                        <option value="En attente">En attente</option>
                        <option value="Annulé">Annulé</option>
                    </select>
                </div>
            </div>
            
            <!-- Tableau des rendez-vous -->
            <div class="table-responsive">
                <table id="rdvTable" class="table table-hover table-bordered" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="min-width-150">Client</th>
                            <th class="min-width-120">Service</th>
                            <th class="min-width-100">Date</th>
                            <th class="min-width-80">Heure</th>
                            <th class="min-width-100">Statut</th>
                            <th class="min-width-150 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rendezvous)): ?>
                            <?php foreach ($rendezvous as $rdv): ?>
                                <tr class="align-middle">
                                    <td><?= esc($rdv['client_nom']) ?></td>
                                    <td><?= esc($rdv['service_nom']) ?></td>
                                    <td data-order="<?= strtotime($rdv['date_rdv']) ?>">
                                        <?= esc($rdv['date_rdv']) ?>
                                    </td>
                                    <td><?= esc($rdv['heure_debut']) ?></td>
                                    <td>
                                        <span class="badge 
                                            <?= $rdv['status'] === 'Validé' ? 'bg-success' : 
                                               ($rdv['status'] === 'Refusé' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                                            <?= esc($rdv['status']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <?php if($rdv['status'] == "En Attente"){ ?>
                                                <a href="<?= base_url('admin/assigner/' . $rdv['id_rendezVous']) ?>"
                                                   class="btn btn-sm btn-success px-3">
                                                    <i class="bi bi-person-check me-1"></i> Assigner
                                                </a>
                                            <?php } ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-calendar-x fs-1"></i>
                                        <p class="mt-2 mb-0">Aucun rendez-vous trouvé</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- CDN Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<!-- CDN DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>

<style>
    #TacheA{
        padding-top: 9.5rem !important;
    }
    .min-width-80 { min-width: 80px; }
    .min-width-100 { min-width: 100px; }
    .min-width-120 { min-width: 120px; }
    .min-width-150 { min-width: 150px; }
    
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
    }
    
    #rdvTable th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3rem 0.75rem !important;
        border-radius: 0.375rem !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }
    
    .dataTables_wrapper .dataTables_info {
        padding-top: 1rem !important;
        font-size: 0.875rem;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        padding-bottom: 1rem;
    }
</style>

<script>
    $(document).ready(function() {
        var table = $('#rdvTable').DataTable({
            dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>',
            order: [[2, "asc"]],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
            },
            responsive: true,
            initComplete: function() {
                $('.dataTables_filter input').addClass('form-control form-control-sm');
                $('.dataTables_length select').addClass('form-select form-select-sm');
            }
        });
        
        // Recherche par nom
        $('#searchNom').on('keyup', function() {
            table.search(this.value).draw();
        });
        
        $('#btnSearch').on('click', function() {
            table.search($('#searchNom').val()).draw();
        });
        
        // Filtre par statut
        $('#filterStatus').on('change', function() {
            table.column(4).search(this.value).draw();
        });
        
        // Gestion du bouton Refuser
        $(document).on('click', '.btn-refuser', function() {
            var idRdv = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir refuser ce rendez-vous ?')) {
                $.post('<?= base_url('admin/refuserRendezVous') ?>', { 
                    id_rendezvous: idRdv 
                }, function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Erreur: ' + response.message);
                    }
                }).fail(function() {
                    alert('Erreur lors de la requête');
                });
            }
        });
    });
</script>

<?=$this->endSection()?>