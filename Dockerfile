# # Use the official PHP image with extensions for Laravel
# FROM php:8.2-fpm

# # Set working directory
# WORKDIR /var/www/html

# # Install system dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip

# # Install PHP extensions required for Laravel
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# # Install Composer
# COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# # Copy application files
# COPY . .

# # Install Laravel dependencies
# RUN composer install --no-dev --optimize-autoloader

# # Set permissions
# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# # Expose port 9000 for PHP-FPM
# EXPOSE 9000

# # Start PHP-FPM
# CMD ["php-fpm"]
