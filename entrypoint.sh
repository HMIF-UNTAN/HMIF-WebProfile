#!/bin/sh
# Buat symlink storage jika belum ada
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link --force
fi
# Jalankan perintah utama container
exec "$@"