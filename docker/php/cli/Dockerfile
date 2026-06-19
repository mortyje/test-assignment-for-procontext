FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

WORKDIR /var/www/html