#!/bin/bash

composer install --no-dev --no-progress -a
php artisan jwt:secret
php artisan migrate
php artisan optimize