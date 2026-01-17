#!/bin/bash
set -e

echo "==> Starting Laravel application setup..."

# Wait for database to be ready
echo "==> Waiting for database connection..."
attempts=0
until php artisan db:show 2>/dev/null || [ "$attempts" -ge 30 ]; do
    echo "Database not ready, waiting... (attempt $attempts/30)"
    attempts=$((attempts + 1))
    sleep 2
done

if [ "$attempts" -ge 30 ]; then
    echo "ERROR: Could not connect to database after 60 seconds"
    exit 1
fi

echo "==> Database connection established"

# Run migrations
echo "==> Running database migrations..."
php artisan migrate --force --no-interaction || echo "Migration failed, continuing..."

# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Create storage link if it doesn't exist
if [ ! -L public/storage ]; then
    echo "==> Creating storage link..."
    php artisan storage:link
fi

echo "==> Laravel setup complete!"
echo "==> Starting PHP server on 0.0.0.0:${PORT:-10000}..."

# Start PHP built-in server
exec php -S "0.0.0.0:${PORT:-10000}" -t public

