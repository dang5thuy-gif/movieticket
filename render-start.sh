#!/bin/bash
set -e

echo "Bắt đầu khởi động trên Render..."

# Fix quyền
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

# KHÔNG chạy config:cache, route:cache, view:cache vì sẽ lỗi bảng cache
# Chỉ clear thôi, không cache lại
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Bật maintenance mode tạm thời để tránh lỗi 500 flash
php artisan down --render="errors::503" || true

# Chạy migrate (nếu có) – nhưng với SQLite file có sẵn thì bỏ qua lỗi
php artisan migrate --force || true

# Tắt maintenance mode
php artisan up

echo "Khởi động Apache..."
exec apache2-foreground