#!/bin/bash
set -e

mkdir -p /app/var

DB_FILE=/app/var/database.db

# nie musi być, ale zrobiłem to po to żeby kontener się zawsze uruchamiał
rm -f "$DB_FILE"
touch "$DB_FILE"

echo "Creating database.db file...: $DB_FILE"
# zrób migrację
php bin/console doctrine:migrations:migrate --no-interaction
# wskaż z którego źródła czerpiemy dane
SQL_FILE=/app/sql/data.sql

# wstaw dane do nowej bazy danych (sqlite zainstalowany w dockerfile)
echo "Insertng $SQL_FILE into $DB_FILE..."
sqlite3 "$DB_FILE" < "$SQL_FILE"

exec php -S 0.0.0.0:8000 -t public
