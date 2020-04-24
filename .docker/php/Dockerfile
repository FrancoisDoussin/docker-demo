FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

RUN docker-php-ext-install pdo pdo_mysql
