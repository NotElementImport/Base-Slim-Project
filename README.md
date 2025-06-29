# [RESTful] Slim Base Project

Base slim project, with basic DDD and Module (Feature) separation.
## Support by default:

* Doctrine ORM
* PHP-DI (Dependency Injection)
* Docker compose (dev, prod, partial (dev without php))
* Public assets
* System with API version

## In the initial project:

* Health check API: `/health-check`
* Auth Service: Example for DI: `/v1/auth/check`
* Dependency Injection
* Doctrine ORM
* Public assets
* MySql Database (Docker)

## Launch for development:

First, let's assemble the `.env` file:
```env
DOCKER_FILE=dev # docker-compose.yaml file, exist value: dev, partial, prod
APP_ENV=dev # App settings

DB_HOST=localhost # Host DB
DB_PORT=3306 # Port DB
DB_NAME=app # Database
DB_USER=root # User
DB_PASS=secret # Password
```

### Makefile:
```console
# Create docker
make @docker/start
# Start slim
make @slim/start
```

### Shell:
```console
# Create docker
docker compose -f ./docker/dev.docker-compose.yaml --env-file ./.env up --build -d
# Start slim
docker compose -f ./docker/dev.docker-compose.yaml exec -d app php -S localhost:8080 ./src/index.php 
```

## What's the approach of this template:

This template uses a mix of Clean Architecture and DDD. As well as a bit of Feature (Modules) structure.

- `/src/app` - This is where the RestController or API is stored. APIServices can also be stored here.
- `/src/config` - Here we set the configuration, DI, Routes, Doctrine.
- `/src/<version>/<module_name>` - Here we store business logic.
