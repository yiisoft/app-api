.DEFAULT_GOAL := help

# Run silent.
MAKEFLAGS += --silent

CLI_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(CLI_ARGS):;@:)

include docker/.env

# Current user ID and group ID.
export UID=$(shell id -u)
export GID=$(shell id -g)

export COMPOSE_PROJECT_NAME=${STACK_NAME}
DOCKER_COMPOSE_DEV := docker compose -f docker/compose.yml -f docker/compose.dev.yml

up: ## Up the dev environment.
	$(DOCKER_COMPOSE_DEV) up -d --remove-orphans

up-build: ## Up the dev environment rebuilding images.
	$(DOCKER_COMPOSE_DEV) up -d --remove-orphans --build

down: ## Down the dev environment.
	$(DOCKER_COMPOSE_DEV) down --remove-orphans

exec: ## Run a command within the existing container.
	$(DOCKER_COMPOSE_DEV) exec app $(CMD) $(CLI_ARGS)

run: ## Run a command within a temporary container.
	$(DOCKER_COMPOSE_DEV) run --rm --entrypoint $(CMD) app $(CLI_ARGS)

cs-fix: ## Run PHP CS Fixer
	$(DOCKER_COMPOSE_DEV) run --rm --entrypoint ./vendor/bin/php-cs-fixer app fix --config=.php-cs-fixer.php --diff

composer-dependency-analyser: ## Run Composer Dependency Analyser
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/composer-dependency-analyser --config=composer-dependency-analyser.php $(CLI_ARGS)

shell: CMD="/bin/sh" ## Get into container shell.
shell: exec

yii: CMD="./yii" ## Execute Yii command.
yii: run

composer: CMD="composer" ## Run Composer.
composer: run

codecept: CMD="./vendor/bin/codecept" ## Run Codeception.
codecept: run

psalm: CMD="./vendor/bin/psalm" ## Run Psalm.
psalm: run

build-prod: ## Build an image.
	docker build --file docker/Dockerfile --target prod --pull -t ${IMAGE}:${IMAGE_TAG} .

push-prod: ## Push image to repository.
	docker push ${IMAGE}:${IMAGE_TAG}

deploy-prod: ## Deploy to production.
	docker -H ${PROD_SSH} stack deploy --with-registry-auth -d -c docker/compose.yml -c docker/compose.prod.yml ${STACK_NAME}

# Output the help for each task, see https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)
