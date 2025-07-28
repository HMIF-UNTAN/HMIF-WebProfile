# --- STAGE 1: Frontend Build (Vite/Node.js) ---
FROM node:20-alpine AS node_builder

WORKDIR /app

# Install dependencies and build assets
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build


# --- STAGE 2: Composer Dependencies ---
FROM composer:2.7 AS composer_installer

WORKDIR /app

# Install composer dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# Dump optimized autoload
RUN composer dump-autoload --optimize --classmap-authoritative --no-scripts


# --- FINAL STAGE: Laravel Application ---
FROM php:8.3-fpm-bullseye

# Install system & PHP extensions
RUN apt-get update && apt-get install -y \
    nginx supervisor git unzip curl \
    libpng-dev libjpeg-dev libwebp-dev libfreetype6-dev \
    libxml2-dev libonig-dev libicu-dev zlib1g-dev \
    libzip-dev libssl-dev default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo pdo_mysql mbstring xml zip gd \
        opcache intl bcmath fileinfo

# Add Composer from previous stage
COPY --from=composer_installer /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

WORKDIR /var/www/html

# Copy built files
COPY --from=node_builder /app/public/build ./public/build
COPY --from=composer_installer /app/vendor ./vendor
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy configuration files
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY supervisord.conf /etc/supervisord.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
