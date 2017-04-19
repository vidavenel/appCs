FROM php:fpm
MAINTAINER Vincent DAVENEL <vincent_mil@hotmail.fr>

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    curl \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng12-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mcrypt \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd

RUN docker-php-ext-install opcache && \
    docker-php-ext-enable opcache

# Copy opcache configration
COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

ADD ./docker/php/laravel.ini /usr/local/etc/php/conf.d
ADD ./docker/php/laravel.pool.conf /usr/local/etc/php-fpm.d/

ADD . /var/www/html

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]
