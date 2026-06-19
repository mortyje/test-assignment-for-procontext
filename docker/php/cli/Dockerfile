FROM php:8.4-cli

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN groupadd -g ${GID} appgroup && \
    useradd -u ${UID} -g appgroup -m appuser

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

USER appuser