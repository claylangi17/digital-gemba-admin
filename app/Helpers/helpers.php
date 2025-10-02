<?php

use App\Helpers\AvatarHelper;

if (!function_exists('get_user_avatar')) {
    /**
     * Get user avatar URL
     * 
     * @param mixed $user
     * @param int $size
     * @return string
     */
    function get_user_avatar($user, $size = 100)
    {
        return AvatarHelper::getUserAvatar($user, $size);
    }
}

if (!function_exists('get_user_cover')) {
    /**
     * Get user cover photo URL
     * 
     * @param mixed $user
     * @return string
     */
    function get_user_cover($user)
    {
        return AvatarHelper::getUserCover($user);
    }
}

if (!function_exists('generate_avatar')) {
    /**
     * Generate avatar URL from seed
     * 
     * @param string $seed
     * @param string $style
     * @param int $size
     * @return string
     */
    function generate_avatar($seed, $style = 'adventurer', $size = 100)
    {
        return AvatarHelper::generateAvatar($seed, $style, $size);
    }
}
