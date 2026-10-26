<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'factory_id', 'production_line', 'name', 'type', 'serial_number', 'status', 'total_operating_hours'
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
