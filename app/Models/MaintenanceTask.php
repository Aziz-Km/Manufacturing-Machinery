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

    protected $casts = [
        'scheduled_date' => 'date',
        'completion_date' => 'date',
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

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'قيد الانتظار',
            'in_progress' => 'جاري العمل',
            'completed' => 'مكتمل',
            default => $this->status ?? 'غير محدد',
        };
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'mechanical' => 'ميكانيكا',
            'electrical' => 'كهرباء',
            'general' => 'عام',
            default => $this->category ?? 'غير محدد',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'preventive' => 'صيانة وقائية',
            'corrective' => 'صيانة تصحيحية',
            default => $this->type ?? 'غير محدد',
        };
    }
}

