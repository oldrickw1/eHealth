FROM php:apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

RUN service apache2 restart

WORKDIR /var/www/html

EXPOSE 80 443
