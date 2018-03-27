FROM php:7.2.3-cli-alpine

RUN apk update && apk upgrade && apk add bash git

# Install PHP extensions
ADD install-php.sh /usr/sbin/install-php.sh
RUN ["chmod", "+x", "/usr/sbin/install-php.sh"]
RUN /usr/sbin/install-php.sh

COPY xdebug.ini $PHP_INI_DIR/conf.d/

WORKDIR /var/www
CMD php -S 0.0.0.0:80 -t ./public
EXPOSE 80