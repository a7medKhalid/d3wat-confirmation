#!/usr/bin/env bash
# Laravel Forge deploy script for d3wat-confirmation
# Paste into Forge → Site → Deployment Script (adjust paths if needed)

set -e

cd "$FORGE_SITE_PATH"

git pull origin "$FORGE_SITE_BRANCH"

# codeload.github.com zip downloads often fail on Forge (HTTP 400).
# Prefer git clones; fall back to dist if source is unavailable.
if ! composer install --no-interaction --prefer-source --no-dev --optimize-autoloader; then
    composer clear-cache
    composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader
fi

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

composer run-script deploy --no-interaction

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:optimize

echo "Deploy finished."
