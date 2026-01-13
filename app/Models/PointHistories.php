<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointHistories extends Model
{
    protected $fillable = [
        'userid',
        'description',
        'type', 
        'category', 
        'point_before', 
        'point_earned',
        'point_after', 
    ];
}
