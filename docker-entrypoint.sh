#!/bin/bash
set -e

echo "Running Laravel setup..."

# Wait for database to be ready
echo "Waiting for database..."
sleep 10

# Run migrations
php artisan migrate --force --no-interaction

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if it doesn't exist
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

echo "Laravel setup complete!"

# Execute the main container command
exec "$@"
