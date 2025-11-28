<?php

namespace App\Controllers;
use App\Models\CalendarModel;
use CodeIgniter\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        return view('admin/calendar_view');
    }

    public function getEvents()
    {
        $model = new CalendarModel();
        $events = $model->getEvents();

        return $this->response->setJSON($events);
    }
}
