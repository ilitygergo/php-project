FROM php:7-fpm

RUN apt-get update \
    && apt-get install -y \
    curl \
    git

# Installing npm
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
COPY package*.json ./
RUN apt-get update \
    && apt-get install -y \
    npm
RUN npm install -g

# Additional Php extensions
RUN docker-php-ext-install mysqli
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini

COPY php.ini /usr/local/etc/php/
