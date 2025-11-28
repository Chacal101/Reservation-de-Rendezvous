<?=$this->include('layout/HeaderClient')?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un Rendez-vous</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --accent-color: #3a0ca3;
            --sidebar-width: 250px;
            --header-height: 70px;
        }
        
        body {
            padding-top: var(--header-height);
        }
        
        .main-container {
            display: flex;
            min-height: calc(100vh - var(--header-height));
        }
        
        .sidebar-container {
            width: var(--sidebar-width);
            position: fixed;
            left: 0;
            top: var(--header-height);
            height: calc(100vh - var(--header-height));
            z-index: 1000;
        }
        
        .content-container {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        .rdv-form-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .calendar-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .form-title, .calendar-title {
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .form-title:after, .calendar-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        
        .calendar-title {
            text-align: center;
        }
        
        .calendar-title:after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        #calendar {
            margin-top: 1rem;
        }
        
        .btn-submit {
            background: var(--primary-color);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .content-container {
                margin-left: 0;
                padding: 1.5rem;
            }
            
            .sidebar-container {
                transform: translateX(-100%);
            }
            
            .sidebar-open .sidebar-container {
                transform: translateX(0);
            }
            
            .sidebar-open .content-container {
                margin-left: var(--sidebar-width);
            }
        }
        
        @media (max-width: 768px) {
            .content-container {
                padding: 1rem;
            }
            
            .rdv-form-container, .calendar-container {
                padding: 1.5rem;
            }
        }
        
        /* FullCalendar adjustments */
        .fc-toolbar-chunk {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
        
        .fc-daygrid-day.occuped {
            background-color: rgba(255, 0, 0, 0.1) !important;
            position: relative;
        }
        
        .fc-daygrid-day.occuped::after {
            content: "Occupé";
            position: absolute;
            bottom: 5px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar-container">
            <?=$this->include('layout/SidebarClient')?>
        </div>

        <!-- Main Content -->
        <div class="content-container">
            <div class="container-fluid">
                <div class="row">
                    <!-- Formulaire -->
                    <div class="col-lg-6 mb-4">
                        <div class="rdv-form-container">
                            <h2 class="form-title">Prendre un Rendez-vous</h2>
                            <form action="<?=site_url('client/soumettreRendezVous')?>" method="post">
                                <input type="hidden" name="service_id" value="<?=esc($service['id_service'])?>">
                                
                                <div class="mb-3">
                                    <label class="form-label">Nom du Service :</label>
                                    <input type="text" class="form-control" value="<?=esc($service['service'])?>" disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Nom du Client :</label>
                                    <input type="text" class="form-control" value="<?=esc($client_nom)?>" disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Date de Rendez-vous :</label>
                                    <input type="date" id="date_rdv" name="date_rdv" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Heure de Début :</label>
                                    <input id="heure_debut" type="time" name="heure_debut" class="form-control" required>
                                </div>
                                
                                <button id="submit_btn" type="submit" class="btn btn-submit w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer la demande
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Calendrier -->
                    <div class="col-lg-6">
                        <div class="calendar-container">
                            <h2 class="calendar-title">Choisissez une date</h2>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let heure_debut = '';
            let heure_fin = '';
            let is_occuped_date = false;
            
            // Initialize Calendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'dayGridMonth',
            selectable: true,
            dateClick: function(info) {
                if (info.dayEl.classList.contains("occuped")) {
                    is_occuped_date = true;
                } else {
                    is_occuped_date = false;
                    document.getElementById("submit_btn").removeAttribute("disabled");
                }

                // Comparaison avec la date actuelle
                const selectedDate = new Date(info.dateStr);
                const today = new Date();
                today.setHours(23, 0, 0, 0); // pour ne pas comparer avec l'heure actuelle

                if (selectedDate > today) {
                    document.getElementById('date_rdv').value = info.dateStr;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Date invalide',
                        text: 'Vous ne pouvez pas prendre rendez-vous à une date passée.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                }
            },
            buttonText: {
                today: "Aujourd'hui",
            }
        });


            calendar.render();

            // Function to get all appointments
            function getAllRdv() {
                const allDays = document.getElementsByClassName('fc-daygrid-day');

                if (allDays.length !== 0) {
                    for (let i = 0; i < allDays.length; i++) {
                        const dayEl = allDays[i];
                        const dateValue = dayEl.getAttribute('data-date');

                        $.post("<?= base_url('client/getAllRdvByService') ?>", {
                            date: dateValue,
                            service: <?= $service['id_service'] ?>,
                        })
                            .done(function(parsedData) {
                                if (parsedData && parsedData.length > 0) {
                                    console.log(parsedData,"parsedData")
                                    // Nettoyage de l’élément
                                    dayEl.innerHTML = '';

                                    parsedData.forEach(rdv => {
                                        const appointmentElement = document.createElement('div');
                                        appointmentElement.className = 'appointment';
                                        appointmentElement.innerHTML = `
                            <div class="appointment-employee">Déjà pris</div>
                            <div class="appointment-hour">à ${rdv.heure_debut}</div>
                        `;

                                        dayEl.appendChild(appointmentElement);
                                        dayEl.classList.add('occuped');

                                        dayEl.addEventListener("click", () => {
                                            heure_debut = rdv.heure_debut;
                                            heure_fin = rdv.heure_fin;
                                        });
                                    });
                                }
                            })
                            .fail(function(xhr, status, error) {
                                console.error('XHR:', xhr);
                                console.error('Status:', status);
                                console.error('Error:', error);
                                alert('Erreur lors de la récupération des rendez-vous');
                            });
                    }
                }
            }


            // Navigation buttons event listeners
            document.querySelector('.fc-prev-button')?.addEventListener('click', getAllRdv);
            document.querySelector('.fc-next-button')?.addEventListener('click', getAllRdv);
            
            // Initial load
            getAllRdv();

            // Check availability
            function verifierDisponibilite() {
                const heureDebutChoosed = document.getElementById('heure_debut').value;
                
                if(is_occuped_date) {
                    const hourChoused = heureDebutChoosed.split(":")[0];
                    const hour = heure_debut.split(":")[0];
                    
                    if(hourChoused === hour) {
                        alert("Ce créneau est déjà occupé");
                        document.getElementById("submit_btn").setAttribute("disabled", "disabled");
                    } else {
                        document.getElementById("submit_btn").removeAttribute("disabled");
                    }
                } else {
                    document.getElementById("submit_btn").removeAttribute("disabled");
                }
            }

            document.getElementById('heure_debut').addEventListener('change', verifierDisponibilite);
        });
    </script>
</body>
</html>

<style>
    .appointment{
        font-size: 9px;
        text-align: center;
    }
    .occuped .fc-daygrid-day-frame{
        display: none!important;
    }
</style>