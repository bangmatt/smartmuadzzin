#!/bin/bash
# Stop immediately if any setup command fails.
set -e

# This script is executed when the dev container is started.
echo "Starting the development server... (start.sh)"

# Ensure the MariaDB database service is running.
sudo service mariadb status > /dev/null 2>&1 || (sudo rm -f /run/mysqld/mysqld.sock /run/mysqld/mysqld.pid && sudo service mariadb start)

# (OPTIONAL) Run migrations and seed the database when needed. 
php spark migrate || echo "Failed to run migrations. Please check the database connection settings in .env and ensure the database is accessible."

if [[ "$(mysql -u root -Nse "SELECT EXISTS(SELECT 1 FROM smartmuadzzin.jadwal_sholat);" 2>/dev/null || echo 0)" == "1" ]]; then
    echo "InitialSeeder data already exists; skipping initial seeding."
else
    php spark db:seed InitialSeeder || echo "Failed to run initial seeding. Please check the database connection settings in .env and ensure the database is accessible."
fi

# Start the development server.
#php spark serve --host=0.0.0.0 --port=8080