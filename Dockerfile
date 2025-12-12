FROM php:8.3-apache

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài extensions PHP cần thiết (THÊM pdo_pgsql)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    zlib1g-dev \
    # THÊM CÁC THƯ VIỆN CẦN THIẾT CHO POSTGRES
    libpq-dev \
    # Cấu hình và cài đặt extensions (THÊM pdo_pgsql)
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql bcmath zip exif pcntl \
    # Clean cache
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy code
COPY . .

# Cài dependencies
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Phân quyền storage/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Config Apache cho Laravel
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf \
    && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Expose port (Dùng 80, mặc định của Apache)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]