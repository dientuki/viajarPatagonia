#!/bin/bash

echo "Installing containers... this maybe take some time, go for your coffe or mate"
docker-compose up -d

echo "Coping env file"
cp .env.example .env

echo "Installing Laravel"
docker-compose exec app composer install

echo "Generate hash"
docker-compose exec app php artisan key:generate

echo "Clean cache"
docker-compose exec app php artisan config:cache

echo "Configure Database"
docker-compose exec mariadb mysql -u root < docker/query.sql

echo "Migration & Seed"
docker-compose exec app php artisan migrate:fresh --seed

echo "Installing NPM"
npm install

echo "Running NPM to compile dev stuff"
npm run dev

echo "Open the home!! in the default browser"
xdg-open http://localhost

echo "To stop the containers just run 'docker-compose stop' in the terminal"
echo "Happy coding!"
