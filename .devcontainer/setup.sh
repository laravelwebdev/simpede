#!/bin/bash

echo --- Copy the environment file ...
cp .env.example .env

echo --- Update .env with desired values ...
# Define new values
new_db_connection="DB_CONNECTION=mysql"
new_db_host="DB_HOST=mariadb"
new_db_port="DB_PORT=3306"
new_db_database="DB_DATABASE=simpede"
new_db_username="DB_USERNAME=homestead"
new_db_password="DB_PASSWORD=secret"
new_app_url="APP_URL=http:\/\/127.0.0.1"

# Replace lines in .env.example
sed -i "s/^APP_URL=.*/${new_app_url}/" .env
sed -i "s/^DB_CONNECTION=.*/${new_db_connection}/" .env
sed -i "s/^DB_HOST=.*/${new_db_host}/" .env
sed -i "s/^DB_PORT=.*/${new_db_port}/" .env
sed -i "s/^DB_DATABASE=.*/${new_db_database}/" .env
sed -i "s/^DB_USERNAME=.*/${new_db_username}/" .env
sed -i "s/^DB_PASSWORD=.*/${new_db_password}/" .env

echo "--- Install dependencies ..."
composer update

echo "--- Generate the application key ..."
php artisan key:generate

echo "--- SETUP DONE ---"
