<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskCatalog extends Model
{
    protected $fillable = [
        'sequence',
        'code',
        'description',
        'category',
    ];
}
