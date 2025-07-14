# --- STAGE 1: Frontend Build (Vite/Node.js) ---
FROM node:20-alpine AS node_builder

WORKDIR /app

# Salin dan install dependensi Node
COPY package.json package-lock.json ./
RUN npm install

# Salin seluruh source code untuk proses build frontend
COPY . .
RUN npm run build


# --- STAGE 2: Composer Dependencies ---
FROM composer:2.7 AS composer_installer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts
RUN composer dump-autoload --optimize --classmap-authoritative --no-scripts


# --- STAGE 3: PHP-FPM (Laravel App Server) ---
FROM php:8.3-fpm-bullseye AS laravel_php_fpm

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libwebp-dev libfreetype6-dev \
    libxml2-dev libonig-dev libicu-dev zlib1g-dev libzip-dev libssl-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql mbstring xml zip gd \
    opcache intl bcmath fileinfo \
    && docker-php-ext-enable pdo_mysql opcache

WORKDIR /var/www/html

# Salin source code Laravel
COPY . .

# Salin vendor dan hasil build frontend
COPY --from=composer_installer /app/vendor ./vendor
COPY --from=node_builder /app/public/build ./public/build

# Set permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Salin entrypoint jika ada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

EXPOSE 9000
CMD ["php-fpm"]


# --- STAGE 4: Nginx Web Server ---
FROM nginx:bullseye AS laravel_nginx

# Hapus default config dan salin konfigurasi custom
RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Salin folder public dari Laravel (readonly)
COPY --from=laravel_php_fpm /var/www/html/public /var/www/html/public

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
