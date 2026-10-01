FROM php:7.3-apache

RUN echo "deb http://archive.debian.org/debian/ bullseye main" > /etc/apt/sources.list \
    && echo "deb http://archive.debian.org/debian/ bullseye-updates main" >> /etc/apt/sources.list

COPY ./php.ini /usr/local/etc/php/
RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
  && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv

RUN apt-get install -y vim

RUN apt-get update && apt-get install -y default-mysql-client

RUN apt-get update && apt-get install -y openssh-server

COPY ./php_apache2.conf /etc/apache2/mods-enabled
RUN apache2ctl restart

RUN apt-get update && apt-get install -y --no-install-recommends \
    libmemcached-dev \
    zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install memcached \
    && docker-php-ext-enable memcached
