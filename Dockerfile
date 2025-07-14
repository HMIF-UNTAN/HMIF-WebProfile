#!/bin/sh

# Jalankan storage:link jika belum ada
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link || true
fi

# Jalankan Supervisor (untuk nginx dan php-fpm)
exec /usr/bin/supervisord -c /etc/supervisord.conf
