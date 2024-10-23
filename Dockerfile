FROM ghcr.io/shyim/wolfi-php/frankenphp:8.3 AS base
RUN apk add --no-cache \
    php-frankenphp-8.3-opcache \
    php-frankenphp-8.3-mbstring \
    php-frankenphp-8.3-intl \
    php-frankenphp-8.3-dom \
    php-frankenphp-8.3-curl

FROM base AS prod
COPY . .

FROM composer/composer:latest-bin AS composer

FROM base AS dev
RUN apk add --no-cache \
    php-frankenphp-8.3-phar \
    php-frankenphp-8.3-openssl \
    php-frankenphp-8.3-xml \
    php-frankenphp-8.3-xmlwriter \
    php-frankenphp-8.3-simplexml \
    php-frankenphp-8.3-pdo

COPY --from=composer /composer /usr/bin/composer
