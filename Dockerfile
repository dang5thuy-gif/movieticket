# Sử dụng base image là PHP 8.2 FPM (có thể thay đổi phiên bản)
FROM php:8.2-fpm-alpine

# Cài đặt các extension PHP cần thiết cho Laravel
RUN apk update && apk add --no-cache \
    git \
    curl \
    libxml2-dev \
    postgresql-dev \
    libzip-dev \
    npm \
    # Thêm các thư viện cần thiết cho GD
    libjpeg-turbo-dev \
    libpng-dev \
    freetype-dev \
    # Cài đặt các extension PHP
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath \
    # Cài đặt GD extension
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    # Xóa cache
    && rm -rf /var/cache/apk/*

# Thiết lập thư mục làm việc trong container
WORKDIR /var/www

# Copy tất cả các file của dự án vào thư mục làm việc
COPY . /var/www

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cài đặt các dependencies PHP
RUN composer install --optimize-autoloader --no-dev

# Cài đặt Node.js dependencies và build assets
RUN npm install
RUN npm run build

# Khởi tạo APP_KEY và cache config (Quan trọng)
RUN php artisan key:generate
RUN php artisan config:cache

# Thiết lập quyền cho thư mục storage
RUN chown -R www-data:www-data /var/www/storage
RUN chmod -R 775 /var/www/storage

# Mở cổng 9000 cho PHP-FPM
EXPOSE 9000

# Lệnh mặc định để chạy PHP-FPM
CMD ["php-fpm"]