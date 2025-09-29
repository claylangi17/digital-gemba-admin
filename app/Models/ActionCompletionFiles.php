<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function getImageUrlAttribute()
    {
        $path = $this->path;

        if (!$path) {
            return asset('assets/images/appreciation/default.png');
        }

        // Jika path sudah berupa URL lengkap, langsung kembalikan
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Untuk file yang berada di storage lokal aplikasi
        if (Str::startsWith($path, 'uploads/')) {
            $normalizedPath = ltrim($path, '/');

            if (Storage::disk('public')->exists($normalizedPath)) {
                return asset('storage/' . $normalizedPath);
            }
        }

        // Default: gunakan media proxy untuk menghindari masalah SSL pada server eksternal
        $filePath = Str::after($path, 'uploads/');
        $filePath = ltrim($filePath, '/');

        return route('media.proxy', ['path' => $filePath]);
    }
}
