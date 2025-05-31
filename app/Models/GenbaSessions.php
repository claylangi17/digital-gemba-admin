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
    ];
}
