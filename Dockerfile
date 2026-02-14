# Dockerfile
FROM php:8.2-cli-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apk add --no-cache zip unzip git mysql-client && \
    docker-php-ext-install pdo_mysql && \
    addgroup -g 1000 appuser && \
    adduser -D -u 1000 -G appuser appuser

WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /package

RUN composer create-project symfony/skeleton . && \
    composer config repositories.local '{"type": "path", "url": "/package"}' && \
    composer config allow-plugins.phpro/grumphp true && \
    composer require --dev phpro/grumphp symfony/maker-bundle && \
    composer require --dev jonmldr/grumphp-doctrine-task:@dev && \
    composer require symfony/orm-pack && \
    git init && \
    git config user.email "test@example.com" && \
    git config user.name "Test User" && \
    git add . && \
    git commit -m "Initial commit"

COPY grumphp.yml.test grumphp.yml
COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh && chown -R appuser:appuser /app

USER appuser

ENTRYPOINT ["/entrypoint.sh"]
