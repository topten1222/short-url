FROM php:7.3.0-fpm-alpine

RUN php -i | grep curl && php -m | grep curl
RUN apk upgrade --update && apk --no-cache add \
    wget zip unzip \
    libzip-dev \
    docker git autoconf \
    file \
    g++ \
    gcc \
    binutils \
    isl \
    libatomic \
    libc-dev \
    musl-dev \
    make \
    re2c \
    libstdc++ \
    libgcc \
    mpc1 \
    mpfr3 \
    gmp \
    libgomp \
    coreutils \
    freetype-dev \
    libjpeg-turbo-dev \
    libltdl \
    libmcrypt-dev \
    libpng-dev \
    openssl-dev \
    libxml2-dev \
    expat-dev \
    icu-dev \
    bash \
    && docker-php-ext-install iconv mysqli pdo pdo_mysql bcmath mbstring json xml zip opcache intl  \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install mysqli pdo pdo_mysql
# TimeZone
RUN apk add tzdata \
&& cp /usr/share/zoneinfo/Asia/Bangkok /etc/localtime \
&& echo "Asia/Bangkok" >  /etc/timezone \
&& apk del tzdata

# Install Composer && Assets Plugin
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin && \
    ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

EXPOSE 9000
CMD ["php-fpm"]