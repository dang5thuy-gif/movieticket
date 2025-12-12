#!/bin/bash
set -e

echo "Bắt đầu fix permissions & cache cho Render..."
chmod -R 777 storage bootstrap/cache || true

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Khởi động Apache..."
exec apache2-foreground