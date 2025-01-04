#!/bin/bash

# Wait for the database to be ready
echo "Waiting for database connection..."
while ! nc -z db 3306; do
    sleep 1
done

echo "Database is ready!"

# Run Laravel commands
php artisan key:generate --ansi
php artisan migrate --force

# Start PHP-FPM
exec "$@"
