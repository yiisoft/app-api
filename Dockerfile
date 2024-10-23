FROM ghcr.io/shyim/wolfi-php/frankenphp:8.3 AS base
RUN apk add --no-cache \
    php-frankenphp-8.3-opcache \
    php-frankenphp-8.3-mbstring \
    php-frankenphp-8.3-intl

FROM base AS prod
COPY . .

FROM composer/composer:latest-bin AS composer

FROM base AS dev
RUN apk add --no-cache \
    php-frankenphp-8.3-phar

COPY --from=composer /composer /usr/bin/composer
