FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libicu-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Copy Xdebug configuration
COPY .docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Fix permissions
RUN chown -R www-data:www-data /var/www
