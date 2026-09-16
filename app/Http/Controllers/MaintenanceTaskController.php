<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = \App\Models\MaintenanceTask::with(['machine', 'engineer.user'])->paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $machines = \App\Models\Machine::all();
        $engineers = \App\Models\Engineer::with('user')->get();
        $catalogs = \App\Models\TaskCatalog::orderBy('sequence')->get();
        return view('tasks.create', compact('machines', 'engineers', 'catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'engineer_id' => 'nullable|exists:engineers,id',
            'task_catalog_id' => 'nullable|exists:task_catalogs,id',
            'category' => 'required|in:mechanical,electrical,general',
            'type' => 'required|in:preventive,corrective',
            'scheduled_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = 'pending'; // Default status

        \App\Models\MaintenanceTask::create($validated);

        return redirect()->route('tasks.index')->with('success', 'تم إصدار أمر الصيانة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
