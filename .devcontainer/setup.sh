#!/bin/bash
# Stop immediately if any setup command fails.
set -e

# This script is executed after the dev container is created.
# It is used to set up the development environment.
echo "Setting up the development environment... (setup.sh)"

# Mark the workspace as trusted so Git permits operations in the container.
git config --global --add safe.directory '*'

# Prepare the environment file for use in the dev container.
ENV_FILE="env"

# Copy the project's root environment file to .env.
cp env .env

# Install the PHP dependencies defined in composer.json.
# Running Composer from the workspace root ensures the project's dependencies
# are installed into the expected vendor directory.
composer install

# Ensure the MariaDB database service is running.
sudo service mariadb start

# Wait for daemon initialization.
echo "Waiting for MariaDB server to respond..."
until sudo mysqladmin ping --silent 2>/dev/null; do
    sleep 1
done

# Check and configure root authentication.
if mysql -u root -e "SELECT 1;" >/dev/null 2>&1; then
    echo "Root passwordless login is already configured."
elif sudo mysql -e "SELECT 1;" >/dev/null 2>&1; then
    echo "First-time setup: configuring root authentication..."
    sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('');"
    sudo mysql -e "FLUSH PRIVILEGES;"
else
    echo "ERROR: Unable to authenticate as root via passwordless connection or system socket." >&2
    exit 1
fi

# Provision the project database when a name is configured.
mysql -u root -e "CREATE DATABASE IF NOT EXISTS smartmuadzzin;" || sudo mysql -e "CREATE DATABASE IF NOT EXISTS smartmuadzzin;"

# Run migrations and seed the database when needed. (optional)
# If migrations fail, change database.default.hostname from localhost to 127.0.0.1
# in .env and run the migration again.
#php spark migrate || echo "Failed to run migrations. Please check the database connection settings in .env and ensure the database is accessible."
#php spark db:seed InitialSeeder || echo "Failed to run initial seeding. Please check the database connection settings in .env and ensure the database is accessible."

# Configure git with your name and email for commits. If not yet configured, uncomment the following line and replace with your details.
#git config --global user.name 'Your Name' && git config --global user.email 'your_email@example.com'