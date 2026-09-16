<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\MaintenanceTaskController;

use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::put('/machines/{machine}/hours', [MachineController::class, 'updateHours'])->name('machines.updateHours')->middleware('can:manage_machines');
    Route::resource('machines', MachineController::class)->middleware('can:manage_machines');
    Route::resource('factories', \App\Http\Controllers\FactoryController::class)->only(['index', 'show'])->middleware('can:manage_factories');
    Route::resource('engineers', EngineerController::class)->middleware('can:manage_engineers');
    Route::resource('tasks', MaintenanceTaskController::class)->middleware('can:manage_tasks');
    
    // Task Catalogs Import
    Route::middleware('can:manage_catalogs')->group(function() {
        Route::get('/catalogs/template', [\App\Http\Controllers\TaskCatalogController::class, 'downloadTemplate'])->name('catalogs.template');
        Route::post('/catalogs/import', [\App\Http\Controllers\TaskCatalogController::class, 'importCsv'])->name('catalogs.import');
        Route::resource('catalogs', \App\Http\Controllers\TaskCatalogController::class)->except(['show', 'edit', 'update']);
    });
    
    // Reports
    Route::get('/reports/machines', [\App\Http\Controllers\ReportController::class, 'machinesReport'])->name('reports.machines')->middleware('can:manage_machines');
    Route::get('/reports/engineers', [\App\Http\Controllers\ReportController::class, 'engineersTasksReport'])->name('reports.engineers')->middleware('can:manage_engineers');
    
    // Only Admin can access users
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::put('/users/{user}/permissions', [UserController::class, 'updatePermissions'])->name('users.updatePermissions');
        Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    });
});
