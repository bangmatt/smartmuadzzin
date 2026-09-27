#!/bin/bash
# Stop immediately if any setup command fails.
set -e

# This script is executed when the dev container is started.
echo "Starting the development server... (start.sh)"

# Ensure the MariaDB database service is running.
sudo service mariadb status > /dev/null 2>&1 || (sudo rm -f /run/mysqld/mysqld.sock /run/mysqld/mysqld.pid && sudo service mariadb start)

#php spark serve --host=0.0.0.0 --port=8080