DOCKER_COMPOSE		= docker-compose
EXEC_PHP			= $(DOCKER_COMPOSE) exec php
SYMFONY				= $(EXEC_PHP) bin/console
COMPOSER			= $(EXEC_PHP) composer

build: start install db

start:
	$(DOCKER_COMPOSE) up -d

kill:
	$(DOCKER_COMPOSE) kill

install: start
	$(EXEC_PHP) composer install

db:
	$(SYMFONY) doctrine:database:drop   --if-exists --force
	$(SYMFONY) doctrine:database:create --if-not-exists --no-interaction
	$(SYMFONY) doctrine:migrations:migrate --allow-no-migration --no-interaction
	$(SYMFONY) doctrine:fixtures:load -n
