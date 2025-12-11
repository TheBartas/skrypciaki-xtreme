FROM php:8.4-cli

# zaktualizuj i zainstaluj sqlite
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev sqlite3 curl \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# przekopiuj hosta do kontenera
COPY backend /app
WORKDIR /app

# zainstaluj php dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# wstaw skrypt startowy
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
