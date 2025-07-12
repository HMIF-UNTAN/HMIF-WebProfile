# --- STAGE 1: Frontend Build (Vite/Node.js) ---
FROM node:20-alpine AS node_builder

WORKDIR /app

# Salin dan install dependensi Node
COPY package.json package-lock.json ./
RUN npm install

# Salin seluruh source code
COPY . .

# Debug: pastikan file ada
RUN ls -lah resources/js && cat resources/js/swiper.js && cat resources/js/admin.js

# Jalankan build Vite dengan config eksplisit
RUN npm run build

# --- STAGE 2: Composer Dependencies ---
FROM composer:2.7 AS composer_installer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts
RUN composer dump-autoload --optimize --classmap-authoritative --no-scripts

# --- STAGE 3: PHP-FPM (Laravel App Server) ---
FROM php:8.3-fpm-bullseye AS laravel_php_fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libxml2-dev \
    libonig-dev \
    libicu-dev \
    zlib1g-dev \
    libzip-dev \
    libssl-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        xml \
        zip \
        gd \
        opcache \
        intl \
        bcmath \
        fileinfo \
    && docker-php-ext-enable \
        pdo_mysql \
        opcache

WORKDIR /var/www/html

# Salin source code Laravel
COPY . .

# Salin hasil vendor dan frontend build dari stage sebelumnya
COPY --from=composer_installer /app/vendor ./vendor
COPY --from=node_builder /app/public/build ./public/build

# Set permission untuk Laravel
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type f -exec chmod 664 {} \; \
    && find /var/www/html -type d -exec chmod 775 {} \; \
    && chmod -R 777 storage bootstrap/cache

EXPOSE 9000

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]

# --- STAGE 4: Nginx Web Server ---
FROM nginx:bullseye AS laravel_nginx

# Hapus default config dan pasang config kustom
RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Salin folder public dan storage dari Laravel stage
COPY --from=laravel_php_fpm /var/www/html/public /var/www/html/public
COPY --from=laravel_php_fpm /var/www/html/storage /var/www/html/storage

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]