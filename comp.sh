#!/usr/bin/env bash
set -e

[ "$#" -lt 1 ] && printf "Please give at least one argument\n" && exit

docker exec -it --user www-data lws-api composer "$@"

exit

