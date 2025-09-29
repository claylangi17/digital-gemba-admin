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

        // For external files, use media proxy to bypass SSL issues
        // Remove any 'uploads/' prefix from the old path to prevent duplication
        $filePath = Str::after($path, 'uploads/');
        
        // Use media proxy route instead of direct external URL
        return route('media.proxy', ['path' => $filePath]);
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

    public function getFileTypeAttribute()
    {
        if (!$this->files) {
            return null;
        }

        $extension = strtolower(pathinfo($this->files, PATHINFO_EXTENSION));
        
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp'];
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
        
        if (in_array($extension, $videoExtensions)) {
            return 'VIDEO';
        } elseif (in_array($extension, $imageExtensions)) {
            return 'PHOTO';
        }
        
        return 'UNKNOWN';
    }
}
