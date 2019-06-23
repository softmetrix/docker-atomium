FROM php:7.2-apache

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV APACHE_DOCUMENT_ROOT=/var/www/html/atomium/web

WORKDIR ~
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN apt update -y
RUN apt install git -y
RUN apt install zip unzip -y
RUN docker-php-ext-install mysqli pdo_mysql
WORKDIR /var/www/html
RUN git clone https://github.com/softmetrix/atomium.git atomium
RUN composer global require "fxp/composer-asset-plugin:dev-master"
WORKDIR /var/www/html/atomium
RUN composer install --no-interaction
COPY config/db.php ./config
COPY config/params.php ./config
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN chmod -R a+w /var/www/html/atomium/runtime
RUN chmod -R a+w /var/www/html/atomium/web/assets
RUN chmod a+x /var/www/html/atomium/install
