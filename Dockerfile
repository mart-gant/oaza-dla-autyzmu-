# Use PHP 8.3 with Apache (compatible with Symfony 8.0)
FROM php:8.3-apache

# CACHE BUSTER - Force new build with intl extension
ENV BUILD_DATE=2026-01-17-14:35
RUN echo "Fresh build with health check fix at $BUILD_DATE"

# Install system dependencies and Node.js 20.x
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (install intl separately with configure)
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# Install intl separately with proper configuration
RUN docker-php-ext-configure intl && \
    docker-php-ext-install intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Copy package files
COPY package*.json ./

# Copy application code early (composer needs it)
COPY --chown=www-data:www-data . .

# Create .env from example (Laravel needs this for bootstrap)
RUN cp .env.example .env || echo "APP_KEY=" > .env

# Install ALL dependencies in one go (let composer handle autoload)
RUN composer install --no-dev --no-interaction --ignore-platform-req=php

# Install Node dependencies (include dev deps for build tools like Vite)
RUN npm ci

# Debug: Check what was installed
RUN echo "=== NPM packages ===" && \
    ls -la node_modules/.bin/ && \
    echo "=== Checking vite ===" && \
    ls -la node_modules/.bin/vite || echo "Vite not found in bin" && \
    echo "=== Package.json scripts ===" && \
    cat package.json

# Verify npm and vite are available
RUN npm --version && node --version && npx vite --version

# Build assets using npx to ensure vite is found
RUN npx vite build

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache with memory optimization for Render free tier (512MB limit)
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf \
    && sed -i 's/StartServers\\s*5/StartServers 1/' /etc/apache2/mods-available/mpm_prefork.conf \
    && sed -i 's/MinSpareServers\\s*5/MinSpareServers 1/' /etc/apache2/mods-available/mpm_prefork.conf \
    && sed -i 's/MaxSpareServers\\s*10/MaxSpareServers 2/' /etc/apache2/mods-available/mpm_prefork.conf \
    && sed -i 's/MaxRequestWorkers\\s*150/MaxRequestWorkers 3/' /etc/apache2/mods-available/mpm_prefork.conf

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
