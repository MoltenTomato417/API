#!/bin/sh
set -e

[ -f .env ] || cp .env.example .env
grep -q '^APP_KEY=.\+' .env || php artisan key:generate --force

echo "Esperando a la base de datos..."
until php -r '
try {
    new PDO(
        "mysql:host=".getenv("DB_HOST").";port=".getenv("DB_PORT").";dbname=".getenv("DB_DATABASE"),
        getenv("DB_USERNAME"),
        getenv("DB_PASSWORD")
    );
    exit(0);
} catch (Throwable $e) {
    exit(1);
}'; do
    sleep 2
done
echo "Base de datos lista."

php artisan migrate --seed --force

exec php artisan serve --host=0.0.0.0 --port=8000 --no-reload