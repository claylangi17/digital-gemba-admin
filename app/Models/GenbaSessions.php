<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenbaSessions extends Model
{
    protected $fillable = [
        'name',
        'whiteboard_id',
        'status',
        'created_by',
        'start_time'
    ];

    public function issues()
    {
        return $this->hasMany(Issues::class, "session_id");
    }

    public function reports()
    {
        return $this->hasMany(GenbaReports::class, "session_id");
    }
}
