# Environment variables
ARG APP_ENV
ARG REMOTE_WORKING_DIR
ARG PHP_VERSION

# PHP Version alpine image to install based on the PHP_VERSION environment variable
FROM php:7.4-fpm-alpine

LABEL maintainer="Andrew Bilenduke <andrewbilenduke@gmail.com>"

# Install Additional dependencies
RUN apk update && apk add --no-cache $PHPIZE_DEPS \
   build-base shadow nano curl gcc git bash \
   php7 \
   php7-fpm \
   php7-common \
   php7-pdo \
   php7-pdo_mysql \
   php7-mysqli \
   php7-mcrypt \
   php7-mbstring \
   php7-xml \
   php7-openssl \
   php7-json \
   php7-phar \
   php7-zip \
   php7-gd \
   php7-dom \
   php7-session \
   php7-zlib

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# install xdebug and enable it if the development environment is local
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000

# Run php-fpm
CMD ["php-fpm"]
