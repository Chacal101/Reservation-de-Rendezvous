<?php

namespace App\Models;
use CodeIgniter\Model;

class CalendarModel extends Model
{
    protected $table = 'rendezvous'; // Remplace par le nom réel de ta table

    public function getEvents()
    {
        return $this->select('id_rendezvous as id, nom_client as title, date_rdv as start')
                    ->findAll();
    }
}
