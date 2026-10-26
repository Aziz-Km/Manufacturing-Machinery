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

    public function engineersTasksReport(Request $request)
    {
        $query = \App\Models\MaintenanceTask::with(['machine.factory', 'engineer.user', 'catalog']);

        if ($request->filled('engineer_id')) {
            $query->where('engineer_id', $request->engineer_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('scheduled_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('scheduled_date', '<=', $request->to_date);
        }

        $tasks = $query->orderBy('scheduled_date', 'desc')->get();
        $engineers = \App\Models\Engineer::with('user')->get();
        $selectedEngineer = $request->filled('engineer_id')
            ? \App\Models\Engineer::with('user')->find($request->engineer_id)
            : null;

        $stats = [
            'total' => $tasks->count(),
            'pending' => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'completed' => $tasks->where('status', 'completed')->count(),
        ];

        return view('reports.engineers', compact('tasks', 'engineers', 'selectedEngineer', 'stats'));
    }
}
