#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>

SHELL = /bin/bash
DC_RUN_ARGS = --rm --user "$(shell id -u):$(shell id -g)"

.PHONY : help install shell init test test-cover up down restart clean shell_prod up_prod restart_prod ps renew_certs artisan artisan_prod deploy deploy_with_docker command command_prod clear_docker
.DEFAULT_GOAL : help

# This will output the help for each task. thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help: ## Show this help
	@printf "\033[33m%s:\033[0m\n" 'Available commands'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z0-9_-]+:.*?## / {printf "  \033[32m%-18s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

install: ## Install all app dependencies
	docker-compose run $(DC_RUN_ARGS) --no-deps app composer install --ansi --prefer-dist

shell: ## Start shell into app container
	docker-compose run $(DC_RUN_ARGS) app sh

init: ## Make full application initialization
	docker-compose run $(DC_RUN_ARGS) app php ./artisan migrate --force --seed
	docker-compose run $(DC_RUN_ARGS) --no-deps app php ./artisan storage:link
	docker-compose run $(DC_RUN_ARGS) --no-deps app php ./artisan key:generate

test: ## Execute app tests
	docker-compose run $(DC_RUN_ARGS) app composer test

test-cover: ## Execute app tests with coverage
	docker-compose run --rm --user "0:0" -e 'XDEBUG_MODE=coverage' app sh -c 'echo "XDebug installing, please wait.." \
		&& apk --no-cache add autoconf make g++ 1>/dev/null && pecl install xdebug-3.1.4 1>/dev/null \
		&& docker-php-ext-enable xdebug 1>/dev/null \
		&& su $(shell whoami) -s /bin/sh -c "composer phpunit"'

up: ## Create and start containers
	APP_UID=$(shell id -u) APP_GID=$(shell id -g) docker-compose up --detach --remove-orphans web queue cron
	@printf "\n   \e[30;42m %s \033[0m\n\n" 'Navigate your browser to ⇒ http://127.0.0.1:8080 or https://127.0.0.1:8443';

down: ## Stop containers
	docker-compose down --remove-orphans

restart: down up ## Restart all containers

clean: ## Make clean
	-docker-compose run $(DC_RUN_ARGS) --no-deps app sh -c "\
		php ./artisan config:clear; php ./artisan route:clear; php ./artisan view:clear; php ./artisan cache:clear file"
	docker-compose down -v # Stops containers and remove named volumes declared in the `volumes` section

shell_prod: ## Start shell into app container
	docker-compose -f docker-compose.prod.yml run $(DC_RUN_ARGS) app sh

up_prod: ## Create and start containers
	APP_UID=$(shell id -u) APP_GID=$(shell id -g) docker-compose -f docker-compose.prod.yml up --detach --remove-orphans web queue cron

restart_prod: down up_prod ## Restart all containers

artisan: # Execute artisan command
	docker-compose run $(DC_RUN_ARGS) app php artisan $(filter-out $@,$(MAKECMDGOALS))

artisan_prod: # Execute artisan command
	docker-compose -f docker-compose.prod.yml run $(DC_RUN_ARGS) app php artisan $(filter-out $@,$(MAKECMDGOALS))

ps: # PS
	docker-compose ps -a

renew_certs_prod: # Renew SSL certs
	docker-compose -f docker-compose.prod.yml exec acme-companion /app/force_renew

deploy:
	php vendor/bin/envoy run deploy

deploy_docker:
	php vendor/bin/envoy run deploy_docker

command:
	docker-compose run $(DC_RUN_ARGS) app /bin/sh -c '$(filter-out $@,$(MAKECMDGOALS))'

command_prod:
	docker-compose -f docker-compose.prod.yml run $(DC_RUN_ARGS) app /bin/sh -c '$(filter-out $@,$(MAKECMDGOALS))'

clear_docker:
	docker stop $(docker ps -a -q)
	docker rm $(docker ps -a -q)
	docker rmi $(docker images -a -q)
	docker volume prune
