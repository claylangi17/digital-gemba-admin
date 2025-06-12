<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RootCauses extends Model
{
    protected $fillable = [
        'issue_id',
        'category',
        'description',
        'supporting_files',
        'created_by',
    ];

    // Relationships
    public function issue()
    {
        return $this->belongsTo(Issues::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files()
    {
        return $this->hasMany(RootCauseFiles::class, 'root_cause_id');
    }
}
