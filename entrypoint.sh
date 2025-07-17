#!/bin/sh

GOOGLE_CREDENTIAL_PATH="/var/www/html/storage/app/google/service-account.json"

# Buat direktori jika belum ada
mkdir -p "$(dirname "$GOOGLE_CREDENTIAL_PATH")"

if [ ! -f "$GOOGLE_CREDENTIAL_PATH" ]; then
    echo "[entrypoint] Membuat file service-account.json dari \$GOOGLE_CREDENTIAL_JSON..."

    php -r '
        $raw = getenv("GOOGLE_CREDENTIAL_JSON");
        if (!$raw) {
            fwrite(STDERR, "[entrypoint] ERROR: GOOGLE_CREDENTIAL_JSON tidak tersedia.\n");
            exit(1);
        }

        // Decode awal untuk jadi array
        $decoded = json_decode($raw, true);
        if (!is_array($decoded)) {
            fwrite(STDERR, "[entrypoint] ERROR: JSON tidak valid.\n");
            exit(2);
        }

        // Perbaiki karakter escaped (newline dan slash)
        if (isset($decoded["private_key"])) {
            $decoded["private_key"] = str_replace(["\\\\n", "\\\\r"], ["\n", "\r"], $decoded["private_key"]);
        }

        // Encode ulang ke file JSON final
        $final = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents("'"$GOOGLE_CREDENTIAL_PATH"'", $final);
    '
fi

# Laravel symlink
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link --force
fi

# Set permission
chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache

# Start Supervisor
exec /usr/bin/supervisord -c /etc/supervisord.conf
