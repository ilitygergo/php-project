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