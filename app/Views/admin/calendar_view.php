
<?=$this->extend('layout/main')?>
<?=$this->section('content')?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #0B0F28;
        color: #fff;
    }
    #calendar {
        width: 86%;
        height: 630px;
        margin: 60px auto;
        background: #1e1e2f;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
    }
    .fc .fc-daygrid-day-top {
        display: flex;
        justify-content: center;
    }
    .legend-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        gap: 20px;
        flex-wrap: wrap;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 3px;
    }
    .validated {
        background-color: #28a745;
    }
    .pending {
        background-color: #ffc107;
    }
    .rejected {
        background-color: #dc3545;
    }
    .fc-event {
        cursor: pointer;
        font-size: 0.85em;
        padding: 2px 5px;
    }
</style>

<h2>Calendrier des Rendez-vous</h2>

<!-- Légende -->
<div class="legend-container">
    <div class="legend-item">
        <div class="legend-color validated"></div>
        <span>Validé</span>
    </div>
    <div class="legend-item">
        <div class="legend-color pending"></div>
        <span>En attente</span>
    </div>
    <div class="legend-item">
        <div class="legend-color rejected"></div>
        <span>Refusé</span>
    </div>
</div>

<div id="calendar"></div>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventDidMount: function(arg) {
                console.log(arg,"dlfld");   
                // Applique la couleur selon le statut
                if (arg.event.extendedProps.status === 'Validé' || arg.event.extendedProps.status === 'Accepté') {
                    arg.el.classList.add('validated');
                } else if (arg.event.extendedProps.status === 'En attente') {
                    arg.el.classList.add('pending');
                } else if (arg.event.extendedProps.status === 'Refusé') {
                    arg.el.classList.add('rejected');
                }
            },
            eventClick: function(info) {
                alert(
                    'Rendez-vous: ' + info.event.title + '\n' +
                    'Statut: ' + info.event.extendedProps.status + '\n' +
                    'Date: ' + info.event.start.toLocaleDateString('fr-FR') + '\n' +
                    'Heure: ' + info.event.extendedProps.heure + '\n' +
                    'Client: ' + info.event.extendedProps.client + '\n' +
                    'Service: ' + info.event.extendedProps.service + '\n' +
                    'Employé: ' + info.event.extendedProps.employe
                );
            },
            height: 'auto',
            eventDisplay: 'block'
        });

        calendar.render();
        getAllRdv();
        function getAllRdv(){
            let allDay = document.getElementsByClassName('fc-daygrid-day');
            if(allDay.length != 0){
                for (let i = 0; i < allDay.length; i++) {
                    let day_case = allDay[i];
                    let date_value = day_case.getAttribute('data-date');

                    $.post("<?= base_url('admin/rendezvous_events') ?>", 
                        {
                            date: date_value,
                        },
                        function(parsedData, status) {
                            // Check if data is not empty
                            if (parsedData && parsedData.length > 0) {
                                // Get the container where we'll add appointments
                                
                                // Clear previous content
                                day_case.innerHTML = '';

                                // Loop through each appointment
                                parsedData.forEach(rdv => {
                                    // Create appointment element
                                    const appointmentElement = document.createElement('div');
                                    appointmentElement.className = 'appointment';
                                    
                                    // Add appointment details
                                    appointmentElement.innerHTML = `
                                        <div class="appointment-client">Client: ${rdv.client_nom || 'N/A'}</div>
                                        <div class="appointment-employee">Employé: ${rdv.employe_nom || 'N/A'}</div>
                                        <div class="appointment-hour">à ${rdv.heure_debut}</div>
                                    `;
                                    
                                    // Add to container
                                    day_case.appendChild(appointmentElement);
                                    if(rdv.status == "Validé"){
                                        day_case.style.background = "green";
                                    }else if(rdv.status == "En Attente"){
                                        day_case.style.background = "yellow";
                                    }
                                    
                                });
                            }
                        }
                    ).fail(function(xhr, status, error) {
                        console.error('Error fetching appointments:', error);
                        // Optionally show error message to user
                        alert('Erreur lors de la récupération des rendez-vous');
                    });
                }
            }

        }
        
        let btn_switch_date_prev = document.querySelector('.fc-prev-button');
        if(btn_switch_date_prev != null){
            btn_switch_date_prev.addEventListener('click',function(){
                getAllRdv();
            })
        }

        let btn_switch_date_next = document.querySelector('.fc-next-button');
        if(btn_switch_date_next != null){
            btn_switch_date_next.addEventListener('click',function(){
                getAllRdv();
            })
        }
    });
</script>
<?=$this->endSection()?>