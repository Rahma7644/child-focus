<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kindergarten extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'logo',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
