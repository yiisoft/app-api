# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# run silent
MAKEFLAGS += --silent

build: ## Build an image
	docker build --target prod --pull -t app-api:latest .

push: ## Push image to repository
	docker push app-api:latest

up: ## Up the dev environment
	docker compose -f docker-compose.dev.yml up -d

down: ## Down the dev environment
	docker compose -f docker-compose.dev.yml down

deploy: ## Deploy to production
	docker -H ssh://docker-web stack deploy --with-registry-auth -d -c docker-compose.prod.yml app-api
