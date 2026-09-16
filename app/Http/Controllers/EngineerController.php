<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EngineerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $engineers = \App\Models\Engineer::with(['user', 'tasks'])->paginate(15);
        return view('engineers.index', compact('engineers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('engineers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'employee_id' => 'required|string|unique:engineers,employee_id|max:50',
            'specialization' => 'required|in:mechanical,electrical,general',
        ]);

        // Create User account automatically
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Assign 'Engineer' role if using Spatie (optional, assuming role exists)
        $user->assignRole('Engineer');

        // Create Engineer profile
        \App\Models\Engineer::create([
            'user_id' => $user->id,
            'employee_id' => $validated['employee_id'],
            'specialization' => $validated['specialization'],
        ]);

        return redirect()->route('engineers.index')->with('success', 'تم إضافة المهندس وإنشاء حساب له بنجاح.');
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
    public function edit(\App\Models\Engineer $engineer)
    {
        return view('engineers.edit', compact('engineer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Engineer $engineer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $engineer->user_id,
            'employee_id' => 'required|string|max:50|unique:engineers,employee_id,' . $engineer->id,
            'specialization' => 'required|in:mechanical,electrical,general',
        ]);

        $engineer->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $engineer->update([
            'employee_id' => $validated['employee_id'],
            'specialization' => $validated['specialization'],
        ]);

        return redirect()->route('engineers.index')->with('success', 'تم تحديث بيانات المهندس بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
