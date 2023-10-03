FROM php:8.2-fpm-alpine

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    --update linux-headers \
    sqlite-dev

## Install PECL and PEAR extensions
RUN pecl install xdebug

RUN docker-php-ext-install \
    pcntl \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    && apk del \
        .build-deps

# Install and enable php extensions
RUN docker-php-ext-enable xdebug

# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && rm -rf /var/cache/apk/*
