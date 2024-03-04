#!/usr/bin/env sh
set -e

docker exec -it --user www-data lws-api php artisan "$@"
