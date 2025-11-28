<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificationClientModel extends Model
{
    protected $table = 'notifications_client';
    protected $primaryKey = 'id_notification';
    protected $allowedFields = ['id_client', 'message', 'date_notification', 'statut','id_rdv'];
    public $timestamps = false;
}
