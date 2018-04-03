FROM php:7.2.3-cli-alpine3.7

ENV REDIS_HOST_VERSION 4.0.0
ENV XDEBUG_VERSION 2.6.0

RUN apk add --no-cache $PHPIZE_DEPS postgresql-dev

RUN pecl install redis-$REDIS_HOST_VERSION \
&& pecl install xdebug-$XDEBUG_VERSION \
&& docker-php-ext-install pdo pdo_pgsql \
&& docker-php-ext-enable redis xdebug

COPY xdebug.ini $PHP_INI_DIR/conf.d/

WORKDIR /var/www