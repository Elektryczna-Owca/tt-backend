COMPOSE_CMD := docker compose

.PHONY: build build-without-cache up down destroy stop restart rebuild rebuild-without-cache ps console

all: console

build:
	$(COMPOSE_CMD) build app

build-without-cache:
	$(COMPOSE_CMD) build app --no-cache

up:
	$(COMPOSE_CMD) up -d

down:
	$(COMPOSE_CMD) down

destroy:
	$(COMPOSE_CMD) down -v

stop:
	$(COMPOSE_CMD) stop

restart: stop up

rebuild: destroy build console

rebuild-without-cache: destroy build-without-cache console

ps:
	$(COMPOSE_CMD) ps

console: up
	$(COMPOSE_CMD) exec app /bin/zsh

chmods:
	sudo chmod -R 777 storage bootstrap
