<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    protected $fillable = [
        'kindergarten_id',
        'image',
        'name',
        'description',
        'level',
        'capacity'
    ];

    public function kindergarten()
    {
        return $this->belongsTo(Kindergarten::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
