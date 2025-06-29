include .env

MODE = $(DOCKER_FILE)
DOCKER = docker compose
DEFAULT_DOCKER = $(DOCKER) -f ./docker/$(MODE).docker-compose.yaml --env-file ./.env
GIT_VERSION = $(shell git tag --contains HEAD)

PHP = $(shell if [ "$(MODE)" != "partial" ]; then echo "$(DEFAULT_DOCKER) exec -d app php"; else echo "php"; fi)

@docker/start:
	@$(DEFAULT_DOCKER) up --build -d

@docker/stop:
	@$(DEFAULT_DOCKER) stop

@docker/ps:
	@$(DEFAULT_DOCKER) ps

@slim/start:
	@$(PHP) -S localhost:8080 ./src/index.php

@changelog:
	@for tag in $$(git tag --sort=-creatordate); do \
    echo "$$tag"; \
    git log "$${tag}" --pretty=format:" - %s"; \
    echo "";\
	done
