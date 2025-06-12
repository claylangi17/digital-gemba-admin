<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RootCauseFiles extends Model
{
    protected $fillable = [
        "root_cause_id",
        "user_id",
        "type",
        "path",
    ];

    // Relationships
    public function root_cause()
    {
        return $this->belongsTo(RootCauses::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
