<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'total_machines' => \App\Models\Machine::count(),
            'active_machines' => \App\Models\Machine::where('status', 'active')->count(),
            'maintenance_machines' => \App\Models\Machine::where('status', 'maintenance')->count(),
            'stopped_machines' => \App\Models\Machine::where('status', 'stopped')->count(),
            
            'total_engineers' => \App\Models\Engineer::count(),
            
            'total_tasks' => \App\Models\MaintenanceTask::count(),
            'pending_tasks' => \App\Models\MaintenanceTask::where('status', 'pending')->count(),
            'in_progress_tasks' => \App\Models\MaintenanceTask::where('status', 'in_progress')->count(),
            'completed_tasks' => \App\Models\MaintenanceTask::where('status', 'completed')->count(),
        ];

        $recent_tasks = \App\Models\MaintenanceTask::with('machine', 'engineer.user')
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('home', compact('stats', 'recent_tasks'));
    }
}
