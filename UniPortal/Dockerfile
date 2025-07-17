# Dockerfile

# Use official PHP FPM image with required extensions
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Install Composer (from official image)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all files to container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port for Laravel dev server
EXPOSE 8000

# Generate optimized config cache
RUN php artisan config:clear && php artisan config:cache

# Start Laravel using built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
