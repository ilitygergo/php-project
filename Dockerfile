FROM php:7-fpm

RUN apt-get update \
    && apt-get install -y \
    curl \
    mc \
    git

# Additional Php extensions
RUN docker-php-ext-install mysqli
