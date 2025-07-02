<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenbaReports extends Model
{
    protected $fillable = [
        "session_id",
        "filename",
        "path",
    ];

    public function session()
    {
        return $this->belongsTo(GenbaSessions::class, 'session_id', 'id');
    }
}
