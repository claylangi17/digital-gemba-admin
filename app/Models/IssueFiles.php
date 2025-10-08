<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    /**
     * Get the image URL attribute
     * Returns proper URL for both local and external images
     */
    public function getImageUrlAttribute()
    {
        $path = $this->path;

        if (!$path) {
            return 'https://placehold.co/200x200?text=No%20Image'; // Return a default placeholder
        }

        // Check if it's a new, locally stored file (e.g., 'uploads/issue/... ')
        if (Str::startsWith($path, 'uploads/')) {
            return asset('storage/' . $path);
        }

        // For external files, use media proxy to bypass SSL issues
        // Remove any 'uploads/' prefix from the old path to prevent duplication
        $filePath = Str::after($path, 'uploads/');
        
        // Use media proxy route instead of direct external URL
        return route('media.proxy', ['path' => $filePath]);
    }
}
