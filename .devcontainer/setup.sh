#!/bin/bash
# Stop immediately if any setup command fails.
set -e

# This script is executed after the dev container is created.
# It is used to set up the development environment.
echo "Setting up the development environment... (setup.sh)"

# Mark the workspace as trusted so Git permits operations in the container.
git config --global --add safe.directory '*'

# Prepare the environment file for the dev container.
# SCRIPT_DIR: directory of this setup script.
# REPO_ROOT: repository root one level above .devcontainer.
# ENV_FILE: source environment file used to populate the workspace .env.
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
ENV_FILE="${REPO_ROOT}/env"

# Copy the project's root environment file to .env.
if [[ ! -f "${ENV_FILE}" ]]; then
    echo "ERROR: Missing environment file at ${ENV_FILE}" >&2
    exit 1
fi
cp "${ENV_FILE}" "${REPO_ROOT}/.env"

# (VS Code Dev Container) Update the database hostname in .env
# Change `localhost` to `127.0.0.1` because VS Code Dev Container may not resolve `localhost` correctly.
sed -i 's/database\.default\.hostname = localhost/database\.default\.hostname = 127.0.0.1/' "${REPO_ROOT}/.env"

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

# Configure git with your name and email for commits. If not yet configured, uncomment the following line and replace with your details.
#git config --global user.name 'Your Name' && git config --global user.email 'your_email@example.com'