<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppreciationNotes extends Model
{
    protected $fillable = [
        'session_id',
        'by',
        'receivers_id',
        'receivers_name',
        'line',
        'description',
        'files',
    ];
}
