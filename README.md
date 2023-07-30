<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About [wondersite.id](https://wondersite.id)

We developed this project from scratch using these technology stacks:

<p align="center">
  <br>
  <img src="https://skillicons.dev/icons?i=php,laravel,mysql,docker" />
</p>

## Technology Stacks Version

-   PHP v8.2.8
-   Laravel v10.13.5
-   MySQL v8.0

## Local Development Setup

1. Instal PHP https://www.php.net/manual/en/install.php
1. Install docker https://docs.docker.com/engine/install
1. `cp .env.sample .env` and fill the requirement fields on the .env file
1. `composer install`
1. `docker compose up` for starting docker environment
1. `./vendor/bin/sail artisan migrate` for migrating structure database
1. `./vendor/bin/sail artisan app:super-admin {name=Administrator} {email=admin@admin.com} {password=pass}` for creating initial admin data, fill the field `name, email and password` thoroughly or the default data will be created
1. `docker compose down` for stopping docker environment

## Folder Structure

-   **\_frontend**, it's folder for frontend development
-   **other folders** are Laravel folder for backend development
