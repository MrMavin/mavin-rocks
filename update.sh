#!/bin/bash

# Enable maintenance mode
php artisan down

# Pull repository
git reset HEAD --hard
git pull

# Updates
php artisan clear-compiled
composer install
npm install
npm run prod

# Clear
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Cache
php artisan route:cache
php artisan view:cache
php artisan config:cache

# Hooks
php artisan telegram:setup

# Regenerate sitemap
php artisan sitemap:generate

# Disable maintenance mode
php artisan up

# Run unit tests
vendor/bin/phpunit