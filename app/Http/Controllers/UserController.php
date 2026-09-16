<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::with('roles')->paginate(15);
        $roles = \Spatie\Permission\Models\Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'تم تحديث صلاحيات المستخدم بنجاح.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->back()->with('success', 'تم إضافة المستخدم وتعيين صلاحتيه بنجاح.');
    }

    public function resetPassword(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('success', 'تم إعادة ضبط كلمة المرور للمستخدم بنجاح.');
    }

    public function updatePermissions(Request $request, \App\Models\User $user)
    {
        $permissions = $request->input('permissions', []);
        
        // We sync permissions directly to the user (Direct Permissions)
        $user->syncPermissions($permissions);

        return redirect()->back()->with('success', 'تم تخصيص صلاحيات الشاشات للمستخدم بنجاح.');
    }
}
