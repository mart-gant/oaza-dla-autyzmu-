# Use PHP 8.3 with Apache (compatible with Symfony 8.0)
FROM php:8.3-apache

# Install system dependencies and Node.js 20.x
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies (ignore platform requirements for PHP version)
RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --ignore-platform-req=php

# Copy package files
COPY package*.json ./

# Install Node dependencies
RUN npm ci --omit=dev

# Copy application code
COPY --chown=www-data:www-data . .

# Check what was copied
RUN echo "=== Checking copied files ===" && \
    ls -la app/ && \
    ls -la bootstrap/

# Finish composer setup with verbose output
RUN composer dump-autoload --optimize --no-dev -vvv || \
    (echo "=== Composer dump-autoload failed, trying without optimize ===" && \
     composer dump-autoload --no-dev)

# Verify package.json exists and show content
RUN ls -la && cat package.json

# Build assets with verbose output
RUN npm run build -- --debug

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache DocumentRoot
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Create necessary directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy and prepare entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port 80
EXPOSE 80

# Use custom entrypoint
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

# Start Apache
CMD ["apache2-foreground"]
