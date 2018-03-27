#!/bin/sh

apk add freetds freetype icu libintl libldap libjpeg libmcrypt libpng libpq libwebp

#xdebug
apk add autoconf g++ libtool make pcre-dev
pecl install xdebug
docker-php-ext-enable xdebug

#Redis
pecl install redis
docker-php-ext-enable redis

TMP="curl-dev \
    freetds-dev \
    freetype-dev \
    gettext-dev \
    icu-dev \
    jpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev \
    openldap-dev \
    postgresql-dev"

apk add $TMP

docker-php-ext-install \
    curl \
    exif \
    gettext \
    intl \
    pdo_pgsql \
    xmlrpc \
    zip

# Install composer
php -r "readfile('https://getcomposer.org/installer');" | php && \
   mv composer.phar /usr/bin/composer && \
   chmod +x /usr/bin/composer

apk del $TMP