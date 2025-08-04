<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parentt extends Model
{
    protected $fillable = [
        "child_id",
        "name",
        "work_address",
        "phone",
        "relationship",
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
