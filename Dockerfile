# Use PHP 8.3 CLI (lightweight, no Apache)
FROM php:8.3-cli

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

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy package files
COPY package*.json ./

# Copy application code
COPY . .

# Create .env from example
RUN cp .env.example .env || echo "APP_KEY=" > .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-req=php && \
    npm ci && \
    npx vite build

# Create necessary directories with correct permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port (Render sets PORT env var)
EXPOSE ${PORT:-10000}

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["php", "-S", "0.0.0.0:${PORT:-10000}", "-t", "public"]
