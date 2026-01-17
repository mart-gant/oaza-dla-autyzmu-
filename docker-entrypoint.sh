#!/bin/bash
set -e

echo "==> Starting Laravel application setup..."

# Wait for database to be ready
echo "==> Waiting for database connection..."
until php artisan db:show 2>/dev/null || [ $((++attempts)) -ge 30 ]; do
    echo "Database not ready, waiting... (attempt $attempts/30)"
    sleep 2
done

if [ $attempts -ge 30 ]; then
    echo "ERROR: Could not connect to database after 60 seconds"
    exit 1
fi

echo "==> Database connection established"

# Run migrations
echo "==> Running database migrations..."
php artisan migrate --force --no-interaction 2>&1 | tee /tmp/migration.log || {
    echo "ERROR: Migration failed, trying fresh migration..."
    php artisan migrate:fresh --force --no-interaction || {
        echo "ERROR: Fresh migration also failed"
        cat /tmp/migration.log
        exit 1
    }
}

# Cache configuration
echo "==> Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if it doesn't exist
if [ ! -L public/storage ]; then
    echo "==> Creating storage link..."
    php artisan storage:link
fi

echo "==> Laravel setup complete!"
echo "==> Starting application..."

# Execute the main container command
exec "$@"
