<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfilePhoto extends Model
{
    protected $fillable = [
        'user_id',
        'path',
    ]; 
}
