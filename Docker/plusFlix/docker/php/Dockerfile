FROM php:8.4-cli

#sys i sqlite
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev curl \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

COPY entrypoint.sh /app/docker/php/entrypoint.sh
RUN chmod +x /app/docker/php/entrypoint.sh

WORKDIR /app
CMD ["bash"]
