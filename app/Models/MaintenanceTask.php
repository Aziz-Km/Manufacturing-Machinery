<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'machine_id',
        'engineer_id',
        'task_catalog_id',
        'category',
        'type',
        'status',
        'scheduled_date',
        'completion_date',
        'notes',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function engineer()
    {
        return $this->belongsTo(Engineer::class);
    }

    public function catalog()
    {
        return $this->belongsTo(TaskCatalog::class, 'task_catalog_id');
    }
}
