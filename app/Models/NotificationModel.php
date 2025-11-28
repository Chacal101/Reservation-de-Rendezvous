<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id_notification';
    protected $allowedFields = ['id_client', 'id_service', 'date_rdv', 'heure_debut', 'statut', 'created_at','id_rdv'];
}
