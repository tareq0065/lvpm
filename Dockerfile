# Use PHP 8.2
FROM php:8.2-fpm-alpine

# Set the working directory
WORKDIR /var/www/app

# Copy the application files
COPY . .

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/app \
    && chmod -R 775 /var/www/app/storage \
    && chmod -R 775 /var/www/app/bootstrap/cache

# Install system dependencies
RUN apk update && apk add \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

# Install Node.js and npm
RUN apk --no-cache add nodejs npm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader

# Set the default command to run php-fpm
CMD ["php-fpm"]
