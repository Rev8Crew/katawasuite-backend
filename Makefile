#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>

SHELL = /bin/bash
DC_RUN_ARGS = --rm --user "$(shell id -u):$(shell id -g)"

.PHONY : help install shell init refresh test up down restart shell_prod up_prod restart_prod ps renew_certs deploy deploy_build command_prod clear_docker pint
.DEFAULT_GOAL : help

# This will output the help for each task. thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help: ## Show this help
	@printf "\033[33m%s:\033[0m\n" 'Available commands'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z0-9_-]+:.*?## / {printf "  \033[32m%-18s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

install: ## Install all app dependencies
	docker-compose run $(DC_RUN_ARGS) --no-deps app composer install --ansi --prefer-dist
	docker-compose run $(DC_RUN_ARGS) --no-deps app 'php ./artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"'
	docker-compose run $(DC_RUN_ARGS) --no-deps app php artisan telescope:install
	docker-compose run $(DC_RUN_ARGS) --no-deps app php artisan horizon:install

shell: ## Start shell into app container
	docker-compose run $(DC_RUN_ARGS) app sh

init: ## Make full application initialization
	docker-compose run $(DC_RUN_ARGS) app php ./artisan migrate --force --seed
	docker-compose run $(DC_RUN_ARGS) --no-deps app php ./artisan key:generate

refresh: ## Refresh test database
	docker-compose exec web php artisan optimize:clear
	docker-compose exec web php artisan config:clear
	docker-compose exec web php artisan db:wipe --database pgsql_test
	docker-compose exec web php artisan migrate --database pgsql_test
	docker-compose exec web php artisan db:seed --database pgsql_test

test: ## Execute app tests
	docker-compose exec web php artisan test --do-not-cache-result -c phpunit.xml

up: ## Create and start containers
	APP_UID=$(shell id -u) APP_GID=$(shell id -g) docker-compose up --detach --remove-orphans web queue cron horizon
	@printf "\n   \e[30;42m %s \033[0m\n\n" 'Navigate your browser to ⇒ http://127.0.0.1:8080 or https://127.0.0.1:8443';

down: ## Stop containers
	docker-compose down --remove-orphans

restart: down up ## Restart all containers

shell_prod: ## Start shell into app container
	docker-compose -f docker-compose.prod.yml run $(DC_RUN_ARGS) app sh

up_prod: ## Create and start containers
	APP_UID=$(shell id -u) APP_GID=$(shell id -g) docker-compose -f docker-compose.prod.yml up --detach --remove-orphans web queue cron horizon

restart_prod: down up_prod ## Restart all containers

ps: # PS
	docker-compose ps -a

renew_certs_prod: # Renew SSL certs
	docker-compose -f docker-compose.prod.yml exec acme-companion /app/force_renew

deploy: # Deploy to host
	php vendor/bin/envoy run deploy || php vendor/bin/envoy run deploy_docker

deploy_build:
	php vendor/bin/envoy run deploy_build

command_prod:
	docker-compose -f docker-compose.prod.yml exec web /bin/sh -c '$(filter-out $@,$(MAKECMDGOALS))'

pint:
	docker-compose run $(DC_RUN_ARGS) app /bin/sh -c './vendor/bin/pint'

clear_docker:
	docker stop $(docker ps -a -q)
	docker rm $(docker ps -a -q)
	docker rmi $(docker images -a -q)
	docker volume prune
