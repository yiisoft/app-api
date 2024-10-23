FROM ghcr.io/shyim/wolfi-php/frankenphp:8.3 AS base
RUN apk add --no-cache \
    php-frankenphp-8.3-opcache \
    php-frankenphp-8.3-mbstring \
    php-frankenphp-8.3-intl

FROM base AS prod
COPY . .
