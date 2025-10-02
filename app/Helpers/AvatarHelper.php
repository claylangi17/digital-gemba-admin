<?php

namespace App\Helpers;

class AvatarHelper
{
    /**
     * Generate DiceBear avatar URL based on user identifier
     * 
     * @param string $seed - Unique identifier (email, name, or ID)
     * @param string $style - Avatar style (adventurer, avataaars, bottts, fun-emoji, etc.)
     * @param int $size - Avatar size in pixels
     * @return string
     */
    public static function generateAvatar($seed, $style = 'adventurer', $size = 100)
    {
        // Clean the seed to make it URL-safe
        $cleanSeed = urlencode($seed);
        
        // DiceBear API v7 endpoint
        return "https://api.dicebear.com/7.x/{$style}/svg?seed={$cleanSeed}&size={$size}";
    }

    /**
     * Get avatar URL for user profile picture
     * Returns DiceBear avatar if no profile photo exists
     * 
     * @param mixed $user - User model instance
     * @param int $size - Avatar size in pixels
     * @return string
     */
    public static function getUserAvatar($user, $size = 100)
    {
        if ($user && $user->profilePhoto && $user->profilePhoto->path) {
            return asset('storage/' . $user->profilePhoto->path);
        }
        
        // Use email as seed for consistent avatar per user
        $seed = $user->email ?? $user->name ?? 'default';
        return self::generateAvatar($seed, 'adventurer', $size);
    }

    /**
     * Get avatar URL for user cover photo
     * Returns DiceBear pattern if no cover photo exists
     * 
     * @param mixed $user - User model instance
     * @return string
     */
    public static function getUserCover($user)
    {
        if ($user && $user->coverPhoto && $user->coverPhoto->path) {
            return asset('storage/' . $user->coverPhoto->path);
        }
        
        // Use bottts style for cover with different seed
        $seed = ($user->email ?? $user->name ?? 'default') . '-cover';
        return self::generateAvatar($seed, 'shapes', 360);
    }
}
