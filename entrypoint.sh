#!/bin/sh

# ====== Tambahan: Generate file service-account.json dari ENV ======
if [ ! -f /var/www/html/storage/app/google/service-account.json ]; then
    mkdir -p /var/www/html/storage/app/google

    echo "[entrypoint] Membuat file service-account.json dari \$GOOGLE_CREDENTIAL_JSON..."

    php -r "
        \$json = getenv('GOOGLE_CREDENTIAL_JSON');
        if (!\$json) exit(1);
        \$decoded = json_decode(\$json, true);
        if (!is_array(\$decoded)) exit(2);
        if (isset(\$decoded['private_key'])) {
            \$decoded['private_key'] = str_replace('\\\\n', \"\n\", \$decoded['private_key']);
        }
        file_put_contents('/var/www/html/storage/app/google/service-account.json', json_encode(\$decoded, JSON_PRETTY_PRINT));
    "
fi

# ===== Laravel setup =====
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link --force
fi

chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache

# ===== Start Supervisor =====
exec /usr/bin/supervisord -c /etc/supervisord.conf
