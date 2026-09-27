# Dev Container Setup

This repository includes a VS Code Dev Container configuration for local PHP development with MariaDB.

## Prerequisites

Before opening the project in a dev container, make sure you have:

- Docker Desktop or Docker Engine installed and running
- Visual Studio Code
- The Dev Containers extension installed:
  - https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers

## Open in a Dev Container

1. Open the repository in VS Code.
2. Press `F1` or use the Command Palette.
3. Run: `Dev Containers: Reopen in Container`
4. Wait for the container to build and initialize.

This will use the configuration in `.devcontainer/devcontainer.json`.

## Included services

The dev container includes:

- PHP 8.2
- MariaDB
- PHP extensions:
  - `mysqli`
  - `intl`

## Configuration details

The dev container is defined by:

- `.devcontainer/devcontainer.json`
- `.devcontainer/docker-compose.yml`
- `.devcontainer/Dockerfile`

The workspace is mounted to:

- `/workspaces/<project-folder-name>`

Port `8080` is forwarded for local application access.

## Setup scripts

When the container is created, the following scripts run automatically:

- `.devcontainer/setup.sh`
- `.devcontainer/start.sh`

### `setup.sh`
This script:

- ensures Git treats the workspace as safe
- copies `env` to `.env`
- runs `composer install`
- starts the MariaDB service
- configures root access
- creates the `smartmuadzzin` database

### `start.sh`
This script ensures MariaDB is running when the container starts.

## Environment file

The setup script expects a file named `env` in the repository root and copies it to `.env`.

If your project uses a `.env` file for database settings, make sure it is present before opening the container or before running the setup script manually.

Example:

```bash
cp env .env
```
Change database hostname from `localhost` to `127.0.0.1` when working with Codespaces and Dev Container
```bash
database.default.hostname = 127.0.0.1
```