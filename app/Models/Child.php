<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = [
        "user_id",
        "classroom_id",
        "nationality",
        "address",
        "description"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function parentts()
    {
        return $this->hasMany(Parentt::class);
    }
}
