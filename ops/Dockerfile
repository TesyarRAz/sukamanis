FROM php:8.3.4-fpm-alpine

USER root

COPY --chown=www-data:www-data . /var/www

CMD ["php", "artisan", "serve"]