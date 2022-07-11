FROM php:8.1-apache

USER root

COPY ./ /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends cron openssl sudo nano libssl-dev libcurl4-openssl-dev git curl libxml2-dev unzip zlib1g-dev libzip-dev libonig-dev\
    && pecl install mongodb \
    && pecl install zlib zip \
    && cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini \
    && echo "extension=zip.so" >> /usr/local/etc/php/php.ini \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8099