#!/bin/sh
set -eu

cd /var/www/html

mkdir -p database \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

touch database/database.sqlite

php artisan config:clear
php artisan migrate --force

chown -R www-data:www-data database storage bootstrap/cache
chmod 775 database
chmod 664 database/database.sqlite

sed -i "s/^Listen 80$/Listen ${PORT:-10000}/" \
    /etc/apache2/ports.conf

sed -i "s/\*:80/*:${PORT:-10000}/" \
    /etc/apache2/sites-available/000-default.conf

exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf