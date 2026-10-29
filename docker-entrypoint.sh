#!/bin/bash
set -e

# Configure Apache port dynamically (Render supplies PORT, defaults to 80)
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

# Create public storage symlink for uploaded logos
php artisan storage:link --force || true

# Run database migrations and seeders automatically against Aiven MySQL
echo "Running migrations and seeders..."
php artisan migrate --force --seed || true

# Optimize and cache Laravel configurations
echo "Optimizing application cache..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Apache web server on port ${PORT}..."
exec apache2-foreground
