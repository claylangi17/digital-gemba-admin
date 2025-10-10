<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserProfilePhoto extends Model
{
    protected $fillable = [
        'user_id',
        'path',
    ];

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
