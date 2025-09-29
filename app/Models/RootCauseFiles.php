<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getImageUrlAttribute()
    {
        $path = $this->path;

        if (!$path) {
            return asset('assets/images/appreciation/default.png'); // Return a default placeholder
        }

        // Check if it's a new, locally stored file
        if (Str::startsWith($path, 'uploads/')) {
            return asset('storage/' . $path);
        }

        // Otherwise, serve from external storage via media proxy to bypass SSL issues
        $filePath = Str::after($path, 'uploads/');
        $filePath = ltrim($filePath, '/');

        return route('media.proxy', ['path' => $filePath]);
    }
}
