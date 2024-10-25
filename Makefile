.DEFAULT_GOAL := help

# Run silent.
MAKEFLAGS += --silent

RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(RUN_ARGS):;@:)

include .docker/.env

# Current user ID and group ID.
export UID=$(shell id -u)
export GID=$(shell id -g)

up: ## Up the dev environment.
	docker compose -f .docker/compose.dev.yml up -d --remove-orphans

up-build: ## Up the dev environment rebuilding images.
	docker compose -f .docker/compose.dev.yml up -d --remove-orphans --build

down: ## Down the dev environment.
	docker compose -f .docker/compose.dev.yml down --remove-orphans

run: ## Run a command within the container.
	docker compose -f .docker/compose.dev.yml exec app $(CMD) $(RUN_ARGS)

shell: CMD="/bin/sh" ## Get into container shell.
shell: run

yii: CMD="./yii" ## Execute Yii command.
yii: run

composer: CMD="composer" ## Run Composer.
composer: run

codecept: CMD="./vendor/bin/codecept" ## Run Codeception.
codecept: run

psalm: CMD="./vendor/bin/psalm" ## Run Psalm.
psalm: run

build-prod: ## Build an image.
	docker build --file .docker/Dockerfile --target prod --pull -t ${IMAGE}:${IMAGE_TAG} .

push-prod: ## Push image to repository.
	docker push ${IMAGE}:${IMAGE_TAG}

deploy-prod: ## Deploy to production.
	docker -H ssh://docker-web stack deploy --with-registry-auth -d -c .docker/compose.prod.yml ${STACK_NAME}

# Output the help for each task, see https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)
