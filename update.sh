#!/bin/bash

# Enable maintenance mode
php artisan down

composerSum=$(sha1sum "composer.json")
npmSum=$(sha1sum "package.json")
assetsSum=$(tree --du -J -i resources/assets/ | sha1sum);

# Pull repository
git reset HEAD --hard
git pull

newComposerSum=$(sha1sum "composer.json")
newNpmSum=$(sha1sum "package.json")
newAssetsSum=$(tree --du -J -i resources/assets/ | sha1sum);

# Updates
php artisan clear-compiled

if [ "$composerSum" != "$newComposerSum" ]
then
    composer install
fi

if [ "$npmSum" != "$newNpmSum" ]
then
    npm install
fi

if [ "$assetsSum" != "$newAssetsSum" ]
then
    npm run prod
fi

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