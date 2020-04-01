FROM php:7.4.4-fpm-alpine
RUN apk --no-cache add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www