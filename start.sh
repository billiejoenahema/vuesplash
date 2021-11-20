#!/usr/bin/bash

docker-compose exec web php artisan serve --host 0.0.0.0 --port 8081
