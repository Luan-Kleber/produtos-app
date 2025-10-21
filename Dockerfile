FROM php:8.1-apache

# Instala dependências e extensões necessárias, incluindo pdo_pgsql e unzip
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]