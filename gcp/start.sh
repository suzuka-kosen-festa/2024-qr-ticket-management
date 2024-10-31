#!/bin/sh

# ポート変数の代入（デフォルト8080）
PORT=${PORT:-8080}

# Replace LISTEN_PORT in Nginx configuration with the actual port
sed -i "s/LISTEN_PORT/${PORT}/g" /etc/nginx/conf.d/default.conf

php artisan cache:clear 

php artisan config:clear

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
nginx -g "daemon off;"