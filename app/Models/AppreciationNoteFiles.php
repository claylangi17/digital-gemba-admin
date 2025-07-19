<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppreciationNoteFiles extends Model
{
    protected $fillable = [
        "appreciation_note_id",
        "user_id",
        "type",
        "path",
    ];

    // Relationships
    public function appreciationNote()
    {
        return $this->belongsTo(AppreciationNotes::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
