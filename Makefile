.PHONY: all test fix phpstan
current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.DEFAULT_GOAL := help

all: vendor test fix phpstan ## Run all checks.

build: ## Builds container and installs dependencies.
	@docker-compose build
	@make vendor

rebuild: ## Resets the environment.
	@rm -rf tools/vendor
	@make build

vendor: composer.json composer.lock ## Installs dependencies.
	@docker-compose run --rm php composer install
	@docker-compose run --rm php composer --working-dir=tools install

help: ## Prints this help.
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

fix: ## Fixes code with PHP CS Fixer.
	@docker-compose run --rm php tools/bin/php-cs-fixer fix src

phpstan: ## Runs static analysis.
	@docker-compose run --rm php tools/bin/phpstan analyse --level 6 src

cli: ## Goes to shell inside container.
	@docker-compose run php bash

test: ## Runs all unit tests.
	@docker-compose run --rm php composer run-script test
