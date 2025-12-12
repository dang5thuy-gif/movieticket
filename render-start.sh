#!/bin/bash
set -e

echo "Bắt đầu khởi động trên Render..."

# Fix quyền (Quan trọng cho log và cache, nên giữ lại)
# Dùng 775 hoặc 777 cho storage và cache
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

# 1. Bật maintenance mode tạm thời (để tránh người dùng thấy lỗi trong lúc update)
php artisan down --render="errors::503" || true

# 2. CHẠY MIGRATION
# Lệnh này sẽ chỉ chạy các migration mới (chưa có trong bảng 'migrations').
# Đây là cách đúng để giữ lại dữ liệu cũ. Lệnh '|| true' giúp bỏ qua lỗi nếu lệnh không thành công
# nhưng trong trường hợp này, nên đảm bảo nó thành công để các bảng mới được tạo.
php artisan migrate --force

# 3. Clear cache và config cũ
# **Đã sửa lỗi đánh máy 'config:cleara' thành 'config:clear'**
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 4. Tạo lại Cache cấu hình (Rất nên dùng cho môi trường Production để tăng tốc độ load)
# LƯU Ý: Nếu có lỗi liên quan đến env, hãy tạm thời comment 3 dòng này.
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Tắt maintenance mode
php artisan up

echo "Khởi động Apache..."
# Apache là lệnh cuối cùng để giữ container chạy.
exec apache2-foreground