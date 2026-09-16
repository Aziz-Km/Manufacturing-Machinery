<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $fillable = ['name', 'location'];

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
