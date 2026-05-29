FROM php:8.3-cli
RUN apt-get update && apt-get install -y libpdo-mysql-dev && docker-php-ext-install pdo pdo_mysql
WORKDIR /app
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader
EXPOSE 8080
CMD php artisan migrate --force && php -S 0.0.0.0:$PORT -t public