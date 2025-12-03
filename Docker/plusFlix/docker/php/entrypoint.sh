#!/bin/bash
set -e

# Tworzymy katalog var jeśli nie istnieje
mkdir -p /app/var

# Kopiujemy wszystkie pliki z folderu sqlite_source do /app/var/
cp /app/sqlite_source/* /app/var/

# Instalacja zależności Composer
composer install

# Uruchomienie serwera PHP
exec php -S 0.0.0.0:8000 -t public
