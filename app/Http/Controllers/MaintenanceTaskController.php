<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\MaintenanceTask::with(['machine.factory', 'engineer.user', 'catalog']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%")
                  ->orWhereHas('machine', function ($mq) use ($search) {
                      $mq->where('serial_number', 'like', "%{$search}%")
                         ->orWhere('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('engineer.user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $tasks = $query->latest()->paginate(15)->withQueryString();
        $engineers = \App\Models\Engineer::with('user')->get();

        $stats = [
            'total' => \App\Models\MaintenanceTask::count(),
            'pending' => \App\Models\MaintenanceTask::where('status', 'pending')->count(),
            'in_progress' => \App\Models\MaintenanceTask::where('status', 'in_progress')->count(),
            'completed' => \App\Models\MaintenanceTask::where('status', 'completed')->count(),
        ];

        return view('tasks.index', compact('tasks', 'engineers', 'stats'));
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
        $task = \App\Models\MaintenanceTask::with(['machine.factory', 'engineer.user', 'catalog'])->findOrFail($id);
        $engineers = \App\Models\Engineer::with('user')->get();
        return view('tasks.show', compact('task', 'engineers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = \App\Models\MaintenanceTask::with(['machine', 'engineer', 'catalog'])->findOrFail($id);
        $machines = \App\Models\Machine::all();
        $engineers = \App\Models\Engineer::with('user')->get();
        $catalogs = \App\Models\TaskCatalog::orderBy('sequence')->get();
        return view('tasks.edit', compact('task', 'machines', 'engineers', 'catalogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = \App\Models\MaintenanceTask::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
            'engineer_id' => 'nullable|exists:engineers,id',
            'task_catalog_id' => 'nullable|exists:task_catalogs,id',
            'machine_id' => 'sometimes|required|exists:machines,id',
            'category' => 'sometimes|required|in:mechanical,electrical,general',
            'type' => 'sometimes|required|in:preventive,corrective',
            'scheduled_date' => 'sometimes|required|date',
            'completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        if ($validated['status'] === 'completed' && empty($validated['completion_date'])) {
            $validated['completion_date'] = now()->toDateString();
        } elseif ($validated['status'] !== 'completed' && empty($request->input('completion_date'))) {
            $validated['completion_date'] = null;
        }

        $task->update($validated);

        return redirect()->back()->with('success', 'تم تحديث أمر الصيانة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = \App\Models\MaintenanceTask::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'تم حذف أمر الصيانة بنجاح.');
    }
}
