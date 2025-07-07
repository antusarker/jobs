#!/bin/bash

# Wait for PostgreSQL
until PGPASSWORD=$DB_PASSWORD psql -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -c '\q'; do
  >&2 echo "Waiting for PostgreSQL..."
  sleep 2
done

# Run migrations (safe for existing migrations)
php artisan migrate --force

# Clear caches
php artisan optimize:clear

# Start server
exec "$@"