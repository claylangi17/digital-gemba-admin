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
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'by');
    }

    public function files()
    {
        return $this->hasMany(AppreciationNoteFiles::class, 'appreciation_note_id');
    }
}
