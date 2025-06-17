<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionCompletionFiles extends Model
{
    protected $fillable = [
        "action_id",
        "user_id",
        "type",
        "path",
    ];

    // Relationships
    public function action()
    {
        return $this->belongsTo(Actions::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
