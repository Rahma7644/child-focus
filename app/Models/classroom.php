<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
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
        return $this->belongsToMany(Teacher::class, 'classroom_teacher','classroom_id','teacher_id',);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }
}
