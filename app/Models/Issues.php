<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $fillable = [
        'session_id',
        'line',
        'items',
        'assigned_ids',
        'description',
        'files',
        'status',
    ];
}
