FROM php:8.2

# 1. Install system dependencies including postgresql-client
RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git libpq-dev libonig-dev postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql mbstring

# 2. Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .

# 3. Only install dependencies during build
RUN composer install --no-dev --optimize-autoloader

# 4. Startup script will handle migrations
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
EXPOSE 8000