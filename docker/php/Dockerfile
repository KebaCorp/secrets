FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        cron \
        rsyslog \
        curl \
        wget \
        git \
        jq \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxslt-dev \
        libicu-dev \
        libmcrypt-dev \
        libxml2-dev \
        libsodium-dev \
        zlib1g-dev \
        libpcre3-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev \
        libpq5 \
        libpq-dev \
    && ACCEPT_EULA=Y \
        DEBIAN_FRONTEND=noninteractive \
        apt-get install --yes \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure \
        intl \
    && docker-php-ext-install \
        intl \
        xsl \
        soap \
        mysqli \
        pdo_mysql \
        pdo \
        pgsql \
        pdo_pgsql \
    && pecl install \
        mongodb \
        xdebug \
    && docker-php-ext-enable mongodb \
        xdebug

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

# Php.ini
ADD php.ini /usr/local/etc/php

CMD ["php-fpm"]
