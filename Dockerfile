FROM php:8.2-cli-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk add --no-cache zip unzip git linux-headers $PHPIZE_DEPS && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apk del $PHPIZE_DEPS && \
    echo -e "xdebug.mode=debug\nxdebug.start_with_request=yes\nxdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    addgroup -g 1000 appuser && \
    adduser -D -u 1000 -G appuser appuser

WORKDIR /app

COPY --chown=appuser:appuser composer.json composer.lock* ./

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-interaction --prefer-dist

COPY --chown=appuser:appuser . .

USER appuser

CMD ["php", "-a"]
