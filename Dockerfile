FROM php:8.3-apache

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài extensions PHP cho Laravel (fix libzip + clean cache để build nhanh)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql bcmath zip exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy code
COPY . .

# Cài dependencies (chạy sau khi có extensions)
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Phân quyền storage/cache (cho Laravel production)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Config Apache cho Laravel (trỏ vào public + enable rewrite cho .htaccess)
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf \
    && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Expose port
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]