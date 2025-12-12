#!/bin/bash
# Fix permissions
chmod -R 777 storage bootstrap/cache

# Clear + cache lại config để nhận đúng đường dẫn SQLite
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Chạy Apache bình thường
apache2-foreground