#!/bin/bash

echo "Waiting for database connection..."
while ! nc -z "$DB_HOST" "$DB_PORT"; do
    sleep 1
done

echo "Database is ready!"

php artisan key:generate --ansi
php artisan migrate --force

exec "$@"
