FROM composer:2.2 AS composer_base

COPY . /var/www

WORKDIR /var/www

RUN composer install --optimize-autoloader --no-interaction --no-progress --prefer-dist --ignore-platform-req=*

FROM node:22-slim AS node_base

COPY --from=composer_base /var/www /var/www

WORKDIR /var/www

RUN npm install && npm run build

FROM php:8.3-fpm-alpine

USER root

ARG PHP_EXTS="pdo_mysql pcntl gd zip intl exif mysqli"
ARG PHP_PECL_EXTS="redis"
ARG PHP_ENABLE_EXTS="exif redis intl"

RUN apk add --no-cache postgresql-dev msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install -j$(nproc) ${PHP_EXTS} && \
    pecl install ${PHP_PECL_EXTS} && \
    docker-php-ext-enable ${PHP_ENABLE_EXTS} && \
    apk del build-essentials && rm -rf /usr/src/php*

RUN apk add --no-cache \
    libreoffice \
    ttf-dejavu \
    font-noto \
    font-noto-cjk \
    font-noto-emoji \
    font-liberation \
    && fc-cache -f -v

RUN apk add --no-cache nginx wget libreoffice

RUN mkdir -p /run/nginx

ARG PORT=8080
ENV PORT=$PORT

COPY ops/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=node_base --chown=www-data:www-data /var/www /var/www

RUN apk add --no-cache redis

CMD ["sh", "-c", "redis-server --daemonize yes && sh /var/www/ops/nginx/horizon.sh && sh /var/www/ops/nginx/startup.sh"]
