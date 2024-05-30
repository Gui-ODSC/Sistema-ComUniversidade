#!/bin/sh

set -e

php artisan migrate --force --no-interaction
