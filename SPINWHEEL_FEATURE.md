# Spinwheel Area Line Gemba - Dokumentasi

## 📋 Deskripsi
Fitur Spinwheel Area Line Gemba adalah alat interaktif untuk memilih area line gemba secara acak dan adil. Fitur ini membantu dalam rotasi pemeriksaan area yang tidak bias.

## ✨ Fitur Utama

### 1. **Spinwheel Interaktif**
- Roda putar dengan animasi smooth dan menarik
- Setiap segment mewakili satu line dari database
- Warna-warna cerah dan berbeda untuk setiap segment
- Animasi confetti saat hasil keluar

### 2. **Statistik Real-time**
- **Total Area Line**: Menampilkan jumlah total line yang tersedia
- **Total Spin Hari Ini**: Menghitung berapa kali spin dilakukan hari ini
- **Terakhir Dipilih**: Menampilkan line yang terakhir kali terpilih

### 3. **Riwayat Spin**
- Menyimpan riwayat spin hari ini di localStorage
- Menampilkan 10 spin terakhir dengan timestamp
- Fitur hapus riwayat

### 4. **UI/UX Modern**
- Design gradient yang menarik
- Animasi smooth dan responsif
- Card statistics dengan hover effect
- Result card dengan animasi slide-in
- Confetti animation untuk celebration

## 🎨 Komponen UI

### Color Palette
```
Primary: #667eea - #764ba2 (Gradient Purple)
Segments: 15 warna berbeda untuk variasi
Cards: Blue, Green, Purple gradients
```

### Animasi
- **Spin Animation**: 4 detik dengan cubic-bezier easing
- **Confetti**: 50 partikel dengan random colors
- **Hover Effects**: Transform dan shadow transitions
- **Result Card**: Slide-in animation

## 🔧 Teknologi

### Backend
- **Controller**: `SpinwheelController.php`
- **Model**: `Lines.php`
- **Routes**: 
  - `GET /spinwheel` - Halaman utama
  - `GET /spinwheel/lines` - API untuk get lines (AJAX ready)

### Frontend
- **View**: `resources/views/spinwheel/index.blade.php`
- **JavaScript**: Vanilla JS dengan localStorage
- **CSS**: Custom animations dan transitions
- **Icons**: Iconify icons

## 📊 Data Flow

1. Controller mengambil data lines dari database
2. Data dikirim ke view dalam format JSON
3. JavaScript membuat wheel segments secara dinamis
4. User click spin button
5. Wheel berputar dengan random rotation
6. Hasil ditampilkan setelah 4 detik
7. Data disimpan ke localStorage untuk history
8. Statistics di-update secara real-time

## 💾 Local Storage

### Key Format
```javascript
'spinHistory_' + new Date().toDateString()
```

### Data Structure
```json
[
  {
    "line": {
      "id": 1,
      "name": "Line A",
      "description": "Description"
    },
    "timestamp": "2025-01-08T13:30:00.000Z"
  }
]
```

## 🎯 Cara Penggunaan

1. **Akses Menu**: Klik "Spinwheel Area" di sidebar
2. **Lihat Statistik**: Review total lines dan history
3. **Putar Roda**: Klik tombol "Putar Roda"
4. **Lihat Hasil**: Tunggu 4 detik untuk melihat hasil
5. **Putar Lagi**: Klik "Putar Lagi" atau tombol utama
6. **Cek History**: Scroll ke bawah untuk melihat riwayat

## 🔐 Security & Middleware

- Protected dengan middleware `role:superadmin,admin`
- Hanya admin dan superadmin yang bisa akses
- Data validation di controller level

## 🎨 Customization

### Mengubah Jumlah Rotasi
```javascript
// Di file index.blade.php, line ~330
const baseRotation = 360 * (5 + Math.random() * 5); // 5-10 rotations
// Ubah angka 5 dan 10 sesuai kebutuhan
```

### Mengubah Durasi Spin
```css
/* Di section <style>, line ~21 */
.wheel.spinning {
    transition: transform 4s cubic-bezier(0.17, 0.67, 0.12, 0.99);
}
/* Ubah 4s menjadi durasi yang diinginkan */
```

### Menambah Warna Segment
```javascript
// Di file index.blade.php, line ~288
const colors = [
    '#FF6B6B', '#4ECDC4', // ... tambahkan warna baru
];
```

## 📱 Responsive Design

- Desktop: Full width dengan wheel 500px
- Tablet: Adjusted layout
- Mobile: Stack layout (perlu testing lebih lanjut)

## 🚀 Future Enhancements

1. **Database History**: Simpan history ke database
2. **Export Report**: Export history ke PDF/Excel
3. **Sound Effects**: Tambahkan sound saat spin
4. **Multi-language**: Support bahasa lain
5. **Admin Settings**: Customize colors, duration, dll dari admin panel
6. **Analytics**: Statistik line mana yang paling sering terpilih
7. **Fairness Algorithm**: Pastikan semua line punya chance yang sama

## 🐛 Known Issues

- Lint error di Blade syntax (tidak mempengaruhi functionality)
- Responsive design untuk mobile perlu improvement

## 📝 Notes

- History disimpan per hari (reset setiap hari baru)
- Maximum 10 history items per hari
- Wheel segments dibuat dinamis berdasarkan jumlah lines
- Jika tidak ada line, akan muncul pesan warning

## 🎉 Credits

Created with ❤️ for Digital Gemba Admin
