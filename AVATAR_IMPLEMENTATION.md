# Avatar Implementation Guide

## Overview
Implementasi DiceBear Avatars untuk menggantikan placeholder profile picture dengan avatar karakter random yang colorful seperti Kahoot.

## Library yang Digunakan
- **DiceBear Avatars API v7** (https://dicebear.com)
- Style: `adventurer` untuk profile pictures (karakter orang dengan style adventure)
- Style: `shapes` untuk cover photos

## Files yang Dibuat

### 1. Helper Class
**File:** `app/Helpers/AvatarHelper.php`
- `generateAvatar($seed, $style, $size)` - Generate avatar URL dari seed
- `getUserAvatar($user, $size)` - Get avatar untuk user (fallback ke DiceBear jika tidak ada foto)
- `getUserCover($user)` - Get cover photo untuk user (fallback ke DiceBear pattern)

### 2. Global Helper Functions
**File:** `app/Helpers/helpers.php`
- `get_user_avatar($user, $size)` - Helper function untuk digunakan di Blade
- `get_user_cover($user)` - Helper function untuk cover photo
- `generate_avatar($seed, $style, $size)` - Helper function untuk custom avatar

## Files yang Diupdate

### 1. Composer Configuration
**File:** `composer.json`
- Menambahkan autoload untuk helpers.php

### 2. View Files
- `resources/views/users.blade.php` - User management page
- `resources/views/appreciation.blade.php` - Top performers (1st, 2nd, 3rd)
- `resources/views/livewire/modal/view/user.blade.php` - User detail modal
- `resources/views/components/navbar.blade.php` - Navbar profile picture

## Cara Penggunaan

### Di Blade Templates
```blade
{{-- Profile Picture --}}
<img src="{{ get_user_avatar($user, 100) }}" alt="Avatar">

{{-- Cover Photo --}}
<img src="{{ get_user_cover($user) }}" alt="Cover">

{{-- Custom Avatar --}}
<img src="{{ generate_avatar('unique-seed', 'adventurer', 150) }}" alt="Avatar">
```

### Di PHP/Controller
```php
use App\Helpers\AvatarHelper;

// Get user avatar
$avatarUrl = AvatarHelper::getUserAvatar($user, 100);

// Generate custom avatar
$avatarUrl = AvatarHelper::generateAvatar('seed-text', 'adventurer', 100);
```

## Avatar Styles Available
- `adventurer` - Adventure characters (DEFAULT - karakter orang dengan style petualangan)
- `avataaars` - Cartoon avatars (style Pixar/cartoon)
- `lorelei` - Female characters (karakter wanita)
- `micah` - Male characters (karakter pria)
- `fun-emoji` - Emoji style
- `bottts` - Robot avatars
- `shapes` - Abstract shapes (recommended for covers)

## Keuntungan
1. ✅ Tidak ada placeholder jelek lagi
2. ✅ Setiap user punya avatar unik berdasarkan email/name
3. ✅ Avatar konsisten (sama seed = sama avatar)
4. ✅ Colorful dan menarik seperti Kahoot
5. ✅ Tidak perlu upload gambar untuk testing
6. ✅ API gratis dan cepat

## Setup Commands
```bash
# Clear cache Laravel
php artisan optimize:clear

# Jika perlu reload composer autoload
composer dump-autoload
```

## Upload Foto Custom

### Fitur Upload
User dapat upload foto profil dan sampul sendiri melalui form edit user:
1. **Foto Profil** - Akan menggantikan avatar default
2. **Foto Sampul** - Akan menggantikan pattern default
3. **Preview Real-time** - Melihat foto sebelum upload
4. **Tampilkan Foto Lama** - Jika sudah ada foto, akan ditampilkan

### Bug Fixes
- ✅ Fixed `updateOrCreate` untuk profile & cover photo
- ✅ Fixed password update logic (dari `!$request->password` ke `$request->filled('password')`)
- ✅ Added preview functionality untuk foto baru
- ✅ Added display untuk foto yang sudah ada

## Notes
- Avatar di-generate secara real-time dari API DiceBear
- Tidak ada file yang disimpan di server untuk avatar default
- **Jika user upload foto sendiri, foto tersebut akan digunakan dan disimpan di storage**
- Avatar hanya muncul sebagai fallback ketika tidak ada foto upload
- Foto disimpan di: `storage/uploads/user/profile/{user_id}` dan `storage/uploads/user/cover/{user_id}`
