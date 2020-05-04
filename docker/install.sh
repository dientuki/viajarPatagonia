#!/bin/bash

echo "Installing containers... this maybe take some time, go for your coffe or mate"
docker-compose up -d

echo "Coping env file"
cp .env.example .env

echo "Generate hash"
docker-compose exec app php artisan key:generate

echo "Clean cache"
docker-compose exec app php artisan config:cache

echo "Configure Database"
docker-compose exec mariadb mysql -u root < docker/query.sql

echo "Migration & Seed"
docker-compose exec app php artisan migrate:fresh --seed

echo "Stop"
docker-compose stop