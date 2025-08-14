# Joomla 5.0 with Docker

This repository contains a `Dockerfile` and `docker-compose.yml` to run a Joomla 5.0 instance with a MariaDB database.

## Prerequisites

*   Docker
*   Docker Compose

## How to use

1.  **Start the services:**

    ```bash
    docker-compose up -d
    ```

    This will build the Joomla image and start the Joomla and MariaDB containers.

2.  **Complete the Joomla installation:**

    Open your web browser and navigate to `http://localhost:8080`.

    You will be guided through the Joomla web installation process. When asked for the database configuration, use the following credentials:

    *   **Database Type:** MySQLi
    *   **Host Name:** `db`
    *   **Username:** `joomla`
    *   **Password:** `joomla_password`
    *   **Database Name:** `joomla_db`

    Complete the rest of the installation as prompted.

3.  **Access your Joomla site:**

    Once the installation is complete, you can access your Joomla site at `http://localhost:8080`.

    The administrator login will be at `http://localhost:8080/administrator`.

## Customization

You can customize the database credentials in the `docker-compose.yml` file. If you change them, make sure to use the updated credentials during the web installation.
