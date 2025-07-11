<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use Illuminate\Support\Str;

class AppreciationNotes extends Model
{
    public function byUser()
    {
        return $this->belongsTo(User::class, 'by');
    }

    public function getImageUrlAttribute()
    {
        $path = $this->files;

        if (!$path) {
            return 'https://placehold.co/200x200?text=No%20Image'; // Return a default placeholder
        }

        // Check if it's a new, locally stored file (e.g., 'uploads/appreciation/note/... ')
        if (Str::startsWith($path, 'uploads/')) {
            return asset('storage/' . $path);
        }

        // Otherwise, assume it's an old file on the external server.
        // The old paths were inconsistent, so we clean them up.
        $baseUrl = rtrim(env('APPRECIATION_IMAGE_BASE_URL'), '/');
        
        // Remove any 'uploads/' prefix from the old path to prevent duplication
        $filePath = Str::after($path, 'uploads/');

        return "{$baseUrl}/{$filePath}";
    }

    protected $fillable = [
        'session_id',
        'by',
        'receivers_id',
        'receivers_name',
        'line',
        'description',
        'files',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'by');
    }
}
