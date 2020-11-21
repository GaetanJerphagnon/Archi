#You should just run $ make install

DOCKER_COMPOSE  = docker-compose
EXEC_PHP        = $(DOCKER_COMPOSE) exec php
YARN         	= $(EXEC_PHP) yarn
SYMFONY         = $(EXEC_PHP) php bin/console
COMPOSER        = $(EXEC_PHP) composer

ifneq ("$(wildcard .env)","")
    include .env
    export $(shell sed 's/=.*//' .env)
endif


# "make" command displays now the list of commands with description
.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' ./Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
##
## Project
## -----
	
project-install: ## Install your project
install: .env-symfony
	  $(DOCKER_COMPOSE) up -d --remove-orphans
	  $(COMPOSER) install
	  $(YARN) add encore
	  $(YARN) install
	  $(YARN) encore dev
	  $(SYMFONY) d:d:d --if-exists --force
	  $(SYMFONY) d:d:c
	  $(SYMFONY) d:m:m --no-interaction
	  $(SYMFONY) d:f:l --no-interaction

.env-symfony:
	@if [ -f .env.local ]; \
	then\
		echo '\033[0;32m Your symfony .env.local already exist.\033[0m';\
	else\
		echo '\033[0;33m Your symfony .env.local does not exist.\033[0m';\
		touch .env.local;\
		echo "DATABASE_URL=mysql://root:@db_docker_symfony:3306/db_architecte?serverVersion=5.7" > .env.local;\
		echo '\033[0;32m Your symfony .env.local copy from .env has been created\033[0m';\
	fi
##
## Database
## -----

db-validate-schema: ## (d:s:v) Validate the doctrine ORM mapping
db-validate-schema: .env vendor
	$(SYMFONY) doctrine:schema:validate
	
##
## Assets
## -----	

yarn-build:## Runs yarn to build you assets in /public/build
yarn-build:
	$(YARN) encore dev

yarn-build-watch:## Runs yarn to watch your assets
yarn-build-watch:
	$(YARN) encore dev --watch

