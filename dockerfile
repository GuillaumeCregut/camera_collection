FROM php:7.2-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y  libpng-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html/   
RUN mv "./php.ini" "$PHP_INI_DIR/php.ini"
RUN chown -R www-data /var/www/*

