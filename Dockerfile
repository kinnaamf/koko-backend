FROM php:8.2-apache

RUN apt-get update &&  \
    apt-get install -y \
    libmariadb-dev \
    libmariadb-dev-compat

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite
RUN a2enmod headers
