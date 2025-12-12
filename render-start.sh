#!/bin/bash
set -e

echo "Bắt đầu khởi động trên Render..."

# Fix quyền (Phải chạy trong entrypoint vì Dockerfile chỉ chạy 1 lần)
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

# 1. Bật maintenance mode tạm thời
php artisan down --render="errors::503" || true

# 2. CHẠY MIGRATION ĐẦU TIÊN (ĐỂ ĐẢM BẢO BẢNG CÓ TRƯỚC KHI DÙNG)
# Sử dụng 'php artisan migrate --force' cho Render (môi trường Production)
php artisan migrate --force || true

# 3. Clear cache - Bây giờ an toàn hơn vì bảng 'cache' đã tồn tại (nếu dùng database driver)
# Hoặc nếu dùng file driver, lệnh này cũng an toàn.
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 4. Chạy cache lại (tùy chọn - nếu muốn tốc độ)
# php artisan config:cache
# php artisan route:cache
# php artisan view:cache

# 5. Tắt maintenance mode
php artisan up

echo "Khởi động Apache..."
# Apache là lệnh cuối cùng để giữ container chạy
exec apache2-foreground