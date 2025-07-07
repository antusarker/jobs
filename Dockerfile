FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Install dependencies
RUN apk add --no-cache \
    git \
    unzip \
    libpq-dev \
    postgresql-client

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Copy only what's needed for composer install
COPY composer.json composer.lock ./

# Install packages (no scripts)
RUN composer install --no-scripts --no-dev

# Copy everything else
COPY . .

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Run artisan commands AFTER container starts (not during build)
# CMD ["sh", "-c", "php artisan storage:link && php artisan migrate --force && php-fpm"]
CMD ["sh", "-c", "php artisan storage:link && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]