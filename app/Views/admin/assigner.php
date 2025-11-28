<?=$this->extend('layout/main')?>

<?=$this->section('content')?>

<div class="container mt-4" style="padding-top: 50px;">
    <h2 class="mb-4 text-center text-primary fw-bold">Gestion du rendez-vous</h2>

    <div class="row g-4">
        <!-- Détails du Rendez-vous à gauche -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-2 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fs-5">Détails du rendez-vous</h5>
                    <button id="btnRefuser" class="btn btn-sm btn-danger">
                        <i class="bi bi-x-circle me-1"></i> Refuser
                    </button>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <p class="mb-1"><span class="fw-bold text-muted small">Client :</span> <span class="text-dark"><?= esc($client_nom) ?></span></p>
                        <p class="mb-1"><span class="fw-bold text-muted small">Service :</span> <span class="text-dark"><?= esc($service_nom) ?></span></p>
                        <p class="mb-1"><span class="fw-bold text-muted small">Date :</span> <span class="text-dark"><?= esc($rendezvous['date_rdv']) ?></span></p>
                        <p class="mb-2"><span class="fw-bold text-muted small">Heure :</span> <span class="text-dark"><?= esc($rendezvous['heure_debut']) ?></span></p>
                        <p class="mb-2"><span class="fw-bold text-muted small">Statut :</span> 
                            <span class="badge <?= $rendezvous['status'] === 'Confirmé' ? 'bg-success' : 
                                               ($rendezvous['status'] === 'Refusé' ? 'bg-danger' : 'bg-warning') ?>">
                                <?= esc($rendezvous['status'] ?? 'En attente') ?>
                            </span>
                        </p>
                    </div>

                    <hr class="my-3">

                    <h5 class="mb-2 text-primary fs-5">Sélectionner un employé</h5>
                    <form id="assignForm" action="<?= base_url('admin/assignerEmploye') ?>" method="post">
                        <input type="hidden" name="id_rendezvous" value="<?= $rendezvous['id_rendezVous'] ?>">

                        <div class="mb-2">
                            <select name="id_employer" class="form-select form-select-sm" required>
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($employes as $employe): ?>
                                    <option value="<?= $employe['id_employer'] ?>" 
                                        <?= ($rendezvous['id_employer'] == $employe['id_employer']) ? 'selected' : '' ?>>
                                        <?= esc($employe['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                                <i class="bi bi-person-check me-1"></i> Assigner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Calendrier à droite -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary text-white py-2">
                    <h5 class="card-title mb-0 fs-5">Disponibilités</h5>
                </div>
                <div class="card-body p-2">
                    <div id="calendar" style="min-height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CDN Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

<style>
    .fc {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .fc-header-toolbar {
        padding: 0.5rem;
        margin-bottom: 0.5rem !important;
        background: #f8f9fa;
        border-radius: 0.5rem;
    }
    
    .fc-toolbar-title {
        font-size: 1rem;
        font-weight: 600;
    }
    
    .fc-button {
        font-size: 0.8rem;
        padding: 0.3rem 0.6rem;
    }
    
    .fc-daygrid-day-number, 
    .fc-col-header-cell-cushion {
        color: #212529;
        text-decoration: none;
    }
    
    .fc-day-today {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }
    
    .fc-event {
        background-color: #0d6efd;
        border: none;
        padding: 2px 4px;
        font-size: 0.75rem;
    }
    
    .fc-event:hover {
        background-color: #0b5ed7;
    }
    
    #calendar .fc-view-harness {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .fc-timegrid-slots table {
        background: white;
    }
</style>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation du calendrier
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridDay',
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour'
            },
            events: <?= $events ?? '[]' ?>,
            eventContent: function(arg) {
                return {
                    html: '<div class="fc-event-title p-1">' + arg.event.title + '</div>'
                };
            },
            slotMinTime: '08:00:00',
            slotMaxTime: '20:00:00',
            height: 'auto',
            nowIndicator: true,
            navLinks: true
        });
        
        calendar.render();
        
        // Gestion du bouton Refuser
        document.getElementById('btnRefuser').addEventListener('click', function() {
            Swal.fire({
                title: 'Confirmer le refus',
                text: "Êtes-vous sûr de vouloir refuser ce rendez-vous ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, refuser',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('<?= base_url('admin/refuserRendezVous') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_rendezvous: <?= $rendezvous['id_rendezVous'] ?>
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Refusé !',
                                'Le rendez-vous a été marqué comme refusé.',
                                'success'
                            ).then(() => {
                                window.location.href = '<?= base_url('admin/tacheAdmin') ?>';
                            });
                        } else {
                            Swal.fire(
                                'Erreur',
                                data.message || 'Une erreur est survenue',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Erreur',
                            'Une erreur réseau est survenue',
                            'error'
                        );
                    });
                }
            });
        });
        
        // Soumission du formulaire d'assignation
        document.getElementById('assignForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Confirmer l\'assignation',
                text: "Êtes-vous sûr de vouloir assigner cet employé ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, assigner',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>

<?=$this->endSection()?>