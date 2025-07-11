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
        if (!$this->files) {
            // Return a placeholder if no file is set
            return 'https://placehold.co/200x200?text=No%20Image';
        }

        // Directly use the full base URL from .env
        $baseUrl = env('APPRECIATION_IMAGE_BASE_URL');

        // The file path from the database
        $filePath = $this->files;

        // Ensure the base URL ends with a single slash
        $baseUrl = rtrim($baseUrl, '/') . '/';

        // Return the full, absolute URL
        return $baseUrl . $filePath;
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
}
