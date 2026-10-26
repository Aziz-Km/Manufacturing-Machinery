<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Machine::with('factory');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('serial_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $machines = $query->orderBy('serial_number')->paginate(15)->appends(['search' => $request->search]);
        return view('machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('machines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'serial_number' => 'required|string|max:255|unique:machines',
            'name' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
            'production_line' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'total_operating_hours' => 'nullable|integer|min:0',
        ]);

        Machine::create($validated);

        return redirect()->route('machines.index')->with('success', 'تم إضافة الآلة بنجاح.');
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
     * Update operating hours and check for maintenance
     */
    public function updateHours(Request $request, \App\Models\Machine $machine)
    {
        $request->validate([
            'hours_to_add' => 'required|integer|min:1'
        ]);

        $oldHours = $machine->total_operating_hours;
        $machine->total_operating_hours += $request->hours_to_add;
        $machine->save();

        $message = 'تم تحديث ساعات التشغيل بنجاح.';

        // Maintenance Threshold logic (e.g., every 5000 hours)
        $threshold = 5000;
        $oldThresholdLevel = floor($oldHours / $threshold);
        $newThresholdLevel = floor($machine->total_operating_hours / $threshold);

        if ($newThresholdLevel > $oldThresholdLevel) {
            // Threshold crossed, create preventive maintenance task
            \App\Models\MaintenanceTask::create([
                'machine_id' => $machine->id,
                'type' => 'preventive',
                'status' => 'pending',
                'scheduled_date' => now()->addDays(2),
                'notes' => 'أمر صيانة دورية تم إنشاؤه آلياً بسبب تجاوز الآلة ' . ($newThresholdLevel * $threshold) . ' ساعة تشغيل.',
            ]);
            $message .= ' تنبيه: تم إصدار أمر صيانة وقائية آلياً لتجاوز الحد الأقصى لساعات التشغيل!';
        }

        return redirect()->back()->with('success', $message);
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
