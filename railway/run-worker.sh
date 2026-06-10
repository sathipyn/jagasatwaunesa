#!/bin/bash
set -e

php artisan queue:work --sleep=3 --tries=1 --timeout=90
