# Dev Container Setup

This repository includes a VS Code Dev Container configuration for local PHP 8.2 development with MariaDB database support. The container provides a complete, isolated development environment with all necessary dependencies pre-configured.

## Prerequisites

Before opening the project in a dev container, ensure you have:

- Docker Desktop or Docker Engine installed and running on your system
- Visual Studio Code installed
- The Dev Containers extension installed:
  - https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers

## Getting Started

### Opening in a Dev Container

1. Open the repository in VS Code.
2. Press `F1` or use the Command Palette.
3. Run: `Dev Containers: Reopen in Container`
4. Wait for Docker to build and initialize the container (this may take 2-5 minutes on first run).
5. The setup scripts will run automatically to configure your environment.

Once complete, your dev container will be ready with PHP, MariaDB, Composer dependencies, and the `smartmuadzzin` database configured.

## What's Included

The dev container provides:

- PHP 8.2
- MariaDB
- PHP extensions:
  - `mysqli`
  - `intl`
- Composer for PHP dependency management
- Git configuration support for safe repository operations in the container

## Configuration Structure

The dev container setup is defined by these files:

- `.devcontainer/devcontainer.json`
- `.devcontainer/docker-compose.yml`
- `.devcontainer/Dockerfile`
- `.devcontainer/setup.sh`
- `.devcontainer/start.sh`

### Workspace Mount Point

The project is mounted inside the container at:

- `/workspaces/<project-folder-name>`

### Port Forwarding

- Port `8080` is forwarded for local application access.
- You can access the app at `http://localhost:8080`.

## Initialization Scripts

### `setup.sh` - Post-creation environment setup

This script runs when the container is first created and performs the following tasks:

- marks the workspace as a safe Git directory
- copies the repository-level `env` file to `.env`
- updates the database hostname from `localhost` to `127.0.0.1`
- runs `composer install`
- starts the MariaDB service
- configures root database access
- creates the `smartmuadzzin` database if it does not exist

### `start.sh` - Container startup helper

This script ensures MariaDB is running when the container starts, so the app can connect to the database reliably.

## Environment File

The setup script expects a file named `env` in the repository root and copies it to `.env`.

If your project uses a `.env` file for database settings, make sure it is present before opening the container or before running the setup script manually.

Example:

```bash
cp env .env
```

Important: during containerized development, set the database host to `127.0.0.1` instead of `localhost`.

```ini
database.default.hostname = 127.0.0.1
```

## Common Tasks

### Manually rerun setup

```bash
bash .devcontainer/setup.sh
```

### Start MariaDB manually

```bash
bash .devcontainer/start.sh
```

### Access the database from inside the container

```bash
mysql -u root smartmuadzzin
```

### Rebuild the dev container

If the container gets into a bad state or dependencies change:

1. Open the Command Palette
2. Run: `Dev Containers: Rebuild Container`

## Troubleshooting

### Missing `env` file

The setup script exits with an error if the root `env` file is not present. Create it before running setup manually.

### Database connection issues

If the app cannot connect to MariaDB:

- verify `.env` contains `127.0.0.1`
- ensure the MariaDB service is running
- check the output of the setup script for authentication issues

### Git safety errors

This is usually resolved by the script automatically, but if needed:

```bash
git config --global --add safe.directory '*'
```

## Notes

This dev container is intended for local PHP development and is also compatible with GitHub Codespaces, where the same database and runtime configuration is used.

The current workflow reflects the repository's recent Dev Container setup and the associated PHP + MariaDB environment configuration used in this branch.
