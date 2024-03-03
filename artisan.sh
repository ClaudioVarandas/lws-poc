#!/usr/bin/env bash
set -e

docker exec -it --user www-data lws-api php artisan "$@"

exit

