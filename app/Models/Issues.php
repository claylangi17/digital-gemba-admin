<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $fillable = [
        'session_id',
        'line_id',
        'items',
        'assigned_ids',
        'description',
        'status',
    ];

    public function files()
    {
        return $this->hasMany(IssueFiles::class, 'issue_id');
    }

}
