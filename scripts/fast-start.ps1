Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

if (-not (Test-Path "artisan")) {
    throw "Run this script from the Laravel project root folder."
}

Write-Host "Clearing old Laravel caches..."
php artisan optimize:clear

Write-Host "Installing PHP packages in optimized mode..."
composer install --optimize-autoloader

Write-Host "Installing Node packages..."
npm install

Write-Host "Building production assets..."
npm run build

Write-Host "Caching Laravel config, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

Write-Host ""
Write-Host "Done. Start the site with:"
Write-Host "php artisan serve"
