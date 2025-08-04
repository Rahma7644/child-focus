<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'kindergarten_id',
        'specialization',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kindergarten()
    {
        return $this->belongsTo(Kindergarten::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_teacher','teacher_id','classroom_id',);
    }
}
