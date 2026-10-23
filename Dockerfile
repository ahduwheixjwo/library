
# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js ./
COPY public ./public

RUN npm run build


# Stage 2: PHP and Laravel
FROM php:8.4-fpm-bookworm AS app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    nginx \
    libicu-dev \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install \
    pdo_mysql \
    intl \
    zip \
    opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .

RUN composer dump-autoload --no-dev --optimize

COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/laravel-entrypoint
RUN chmod +x /usr/local/bin/laravel-entrypoint

EXPOSE 8080

CMD ["laravel-entrypoint"]
