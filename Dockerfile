FROM php:8.3-cli
RUN apt-get update && apt-get install -y zip unzip libzip-dev && docker-php-ext-install pdo pdo_mysql zip
WORKDIR /var/www/html
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader
EXPOSE 8080
ENTRYPOINT ["sh", "-c", "php artisan migrate --force && php -S 0.0.0.0:${PORT:-8080} -t public"]