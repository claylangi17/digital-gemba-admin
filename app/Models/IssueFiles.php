<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueFiles extends Model
{
    protected $fillable = [
        "issue_id",
        "user_id",
        "type",
        "path",
    ];

    // Relationships
    public function issue()
    {
        return $this->belongsTo(Issues::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
