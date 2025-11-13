# PM2 Setup untuk Laravel Project

## Instalasi PM2

Jika belum terinstall, install PM2 secara global:

```bash
npm install -g pm2
```

## Cara Menjalankan

### Development Mode

Jalankan semua services (Laravel server, queue worker, dan Vite):

```bash
pm2 start ecosystem.config.cjs
```

### Production Mode

Untuk production (tanpa Vite dev server):

```bash
npm run build
pm2 start ecosystem.production.config.cjs
```

## Perintah PM2 Berguna

### Melihat Status
```bash
pm2 status
pm2 list
```

### Melihat Logs
```bash
# Semua logs
pm2 logs

# Log spesifik app
pm2 logs laravel-server
pm2 logs laravel-queue
pm2 logs vite-dev
```

### Monitoring
```bash
pm2 monit
```

### Restart Services
```bash
# Restart semua
pm2 restart all

# Restart spesifik
pm2 restart laravel-server
pm2 restart laravel-queue
```

### Stop Services
```bash
# Stop semua
pm2 stop all

# Stop spesifik
pm2 stop laravel-server
```

### Delete Services
```bash
# Delete semua
pm2 delete all

# Delete spesifik
pm2 delete laravel-server
```

### Reload (Zero Downtime)
```bash
pm2 reload all
```

## Auto Start saat Boot

Untuk menjalankan PM2 otomatis saat sistem restart:

```bash
# Generate startup script
pm2 startup

# Save current process list
pm2 save
```

## Konfigurasi

### Development (ecosystem.config.cjs)
- **laravel-server**: PHP artisan serve di port 8000
- **laravel-queue**: Queue worker dengan 3 tries
- **vite-dev**: Vite development server

### Production (ecosystem.production.config.cjs)
- **laravel-server-prod**: PHP artisan serve
- **laravel-queue-prod**: 2 instances queue worker untuk load balancing

## Logs

Semua logs disimpan di `storage/logs/`:
- `pm2-server-error.log` & `pm2-server-out.log`
- `pm2-queue-error.log` & `pm2-queue-out.log`
- `pm2-vite-error.log` & `pm2-vite-out.log`

## Tips

1. Pastikan file `.env` sudah dikonfigurasi dengan benar
2. Jalankan `composer install` dan `npm install` sebelum start
3. Jalankan `php artisan migrate` untuk setup database
4. Untuk production, selalu build assets dulu: `npm run build`
5. Monitor memory usage dengan `pm2 monit`

## Troubleshooting

Jika ada masalah:

```bash
# Lihat logs detail
pm2 logs --lines 100

# Restart dengan logs
pm2 restart all --update-env

# Flush logs
pm2 flush
```
