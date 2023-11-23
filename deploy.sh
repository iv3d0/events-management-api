#!/usr/bin/env bash
echo "Running composer"
composer update --working-dir=/var/www/html

echo "Caching config..."
php artisan optimize:clear

echo "Creating the database if it is not exists and Running migrations..."
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    php artisan migrate --seed --force
else
    php artisan migrate --force
fi

echo "Running server..."
php artisan serve --host=0.0.0.0 --port=80
