#!/usr/bin/env bash
set -euo pipefail

cd -- "$(dirname -- "${BASH_SOURCE[0]}")/.."
chmod -R a+rX wp-content/themes/dive365 wp-content/plugins/dive365-shop
docker compose up -d --wait

wp_cli=$(mktemp)
trap 'rm -f -- "$wp_cli"' EXIT
curl -fsSL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o "$wp_cli"
docker compose cp "$wp_cli" wordpress:/tmp/wp-cli.phar
docker compose exec -T wordpress chmod a+r /tmp/wp-cli.phar
wp() { docker compose exec -T --user www-data wordpress php /tmp/wp-cli.phar --path=/var/www/html "$@"; }

if ! wp core is-installed; then
    : "${DIVE365_ADMIN_PASSWORD:?Set a password for the local WordPress admin before first startup}"
    wp core install --url="http://127.0.0.1:${DIVE365_PORT:-8080}" --title='Dive 365' \
        --admin_user=dive365_local --admin_email=dive365@example.invalid \
        --admin_password="$DIVE365_ADMIN_PASSWORD" --skip-email
    wp option update blog_public 0
    wp option update timezone_string Asia/Tokyo
    wp rewrite structure '/%postname%/'
fi
wp plugin activate dive365-shop
wp theme activate dive365
wp rewrite flush
