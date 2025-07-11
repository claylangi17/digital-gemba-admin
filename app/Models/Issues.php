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

    public function session()
    {
        return $this->belongsTo(GenbaSessions::class, 'session_id');
    }

    public function getAssignedsAttribute()
    {
        return User::whereIn('id', explode(',', $this->assigned_ids))->pluck('id');
    }
    
    public function files()
    {
        return $this->hasMany(IssueFiles::class, 'issue_id');
    }

    public function line()
    {
        return $this->hasOne(Lines::class, "id", "line_id");
    }

    public function actions()
    {
        return $this->hasMany(Actions::class, "issue_id", "id");
    }
}
