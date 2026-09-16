<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function machinesReport()
    {
        $machines = \App\Models\Machine::with('factory')->orderBy('created_at', 'desc')->get();
        return view('reports.machines', compact('machines'));
    }

    public function engineersTasksReport()
    {
        $tasks = \App\Models\MaintenanceTask::with(['machine', 'engineer.user'])->orderBy('scheduled_date', 'desc')->get();
        return view('reports.engineers', compact('tasks'));
    }
}
