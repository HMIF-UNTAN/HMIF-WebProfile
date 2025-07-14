#!/bin/sh

# Buat symlink storage jika belum ada
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link --force
fi

# Pastikan permission benar
chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache

# Start Supervisor
exec /usr/bin/supervisord -c /etc/supervisord.conf
