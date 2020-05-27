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

# RUN apk add --no-cache \
#     freetype \
#     libpng \
#     libjpeg-turbo \
#     freetype-dev \
#     libpng-dev \
#     libjpeg-turbo-dev \
#     && docker-php-ext-configure gd \
#     --with-freetype \
#     --with-jpeg \ 
#     && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
#     docker-php-ext-install -j${NPROC} gd && \
#     apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

ARG APPLICATION_ENVIRONMENT

# install xdebug and enable it if the development environment is local
RUN if [ "$APPLICATION_ENVIRONMENT" = "local" ] ; then \ 
  pecl install xdebug \
  && docker-php-ext-enable xdebug \
;fi

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data

ARG REMOTE_WORKING_DIR

# Copy existing application directory permissions
COPY --chown=www-data:www-data . $REMOTE_WORKING_DIR

# Change current user to www
USER www-data

# Run php-fpm
CMD ["php-fpm"]

EXPOSE 9000
