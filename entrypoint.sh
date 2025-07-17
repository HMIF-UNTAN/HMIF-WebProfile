#!/bin/sh

# ====== Generate file service-account.json dari ENV ======
GOOGLE_CREDENTIAL_PATH="/var/www/html/storage/app/google/service-account.json"

if [ ! -f "$GOOGLE_CREDENTIAL_PATH" ]; then
    mkdir -p /var/www/html/storage/app/google

    echo "[entrypoint] Membuat file service-account.json dari \$GOOGLE_CREDENTIAL_JSON..."

    php -r "
        \$json = getenv('GOOGLE_CREDENTIAL_JSON');
        if (!\$json) {
            fwrite(STDERR, \"[entrypoint] ERROR: GOOGLE_CREDENTIAL_JSON tidak tersedia.\n\");
            exit(1);
        }

        \$decoded = json_decode(\$json, true);
        if (!is_array(\$decoded)) {
            fwrite(STDERR, \"[entrypoint] ERROR: JSON tidak valid.\n\");
            exit(2);
        }

        // Perbaiki karakter escaped
        if (isset(\$decoded['private_key'])) {
            \$decoded['private_key'] = str_replace(['\\\\n', '\\\\/'], [\"\\n\", \"/\"], \$decoded['private_key']);
        }

        \$encoded = json_encode(\$decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents('$GOOGLE_CREDENTIAL_PATH', \$encoded);
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
