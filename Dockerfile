FROM php:8.3-apache
RUN apt-get update && apt-get install -y zip unzip libzip-dev && docker-php-ext-install pdo pdo_mysql zip
WORKDIR /var/www/html
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
CMD php artisan migrate --force && apache2-foreground