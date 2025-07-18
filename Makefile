# ______________________________________________________________________________________________________________________
# ПОДКЛЮЧЕНИЕ .ENV

include .env

TARGET_BRANCH ?= master
DOCKER ?= laravel-test-php

# ______________________________________________________________________________________________________________________
# КОМАНДЫ УСТАНОВКИ ПРИЛОЖЕНИЯ

# Первая установка и настройка приложения
install:
	sudo apt update
	sudo apt install docker
	sudo apt install docker-compose
	sudo apt install php${PHP_VERSION} php${PHP_VERSION}-cli php${PHP_VERSION}-{bz2,curl,mbstring,intl}
	git checkout ${TARGET_BRANCH}
	git pull
	make env
	make down
	make build
	make up
	make composer
	make key
	make migrate
	make optimize

# ______________________________________________________________________________________________________________________
# ОБЩИЕ КОМАНДЫ

# Копирование файла окружения, если он отсутствует
env:
	@cp -n .env.example .env

# Остановка контейнеров докера
down:
	# @sudo docker-compose down

	./vendor/bin/sail down

# Создание контейнеров докера
build:
	# @sudo docker-compose build

# Запуск контейнеров докера
up:
	# @sudo docker-compose up -d

	./vendor/bin/sail up -d

# Перезапуск контейнеров докера
restart:
	make down
	make up

# Вход в основной контейнер
sh:
	# @sudo docker-compose exec ${DOCKER} sh

# Установка зависимостей
composer-install:
	# @sudo docker-compose exec ${DOCKER} composer install --prefer-dist
	composer install --prefer-dist

composer:
	# git config --global --add safe.directory .
	# @sudo docker-compose exec ${DOCKER} composer update
	composer update
	composer dump-autoload

# Генерация ключа приложения
key:
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan key:generate

# Запуск миграции базы данных
migrate:
	@sudo docker-compose exec ${DOCKER} php artisan migrate
	# @sudo docker-compose exec ${DOCKER} php artisan ide-helper:generate
	# @sudo docker-compose exec ${DOCKER} php artisan ide-helper:models --write

# Запуск миграции базы данных
migrate-fresh:
	read -p "Будет полностью обновлена БД, нажмите ENTER для продолжения...\n" enter
	@sudo docker-compose exec ${DOCKER} php artisan migrate:fresh
	# @sudo docker-compose exec ${DOCKER} php artisan ide-helper:generate
	# @sudo docker-compose exec ${DOCKER} php artisan ide-helper:models --write

# Запуск отката миграции базы данных
migrate-rollback:
	@sudo docker-compose exec ${DOCKER} php artisan migrate:rollback
	# @sudo docker-compose exec ${DOCKER} php artisan ide-helper:generate
	# @sudo docker-compose exec ${DOCKER} php artisan ide-helper:models --write

# Оптимизация и кеширование приложения
optimize:
	@sudo chmod a+w -R ./config/*
	@sudo chmod a+w -R ./storage/*
	@sudo chmod a+w .phpunit.result.cache

	@sudo rm -f -R ./storage/logs/exceptions/*
	@sudo rm -f -R ./storage/tests/*

	@sudo echo '' > storage/logs/laravel.log
	
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan config:clear
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan route:clear
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan cache:clear
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan view:clear
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan clear-compiled
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan config:cache
	# @sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan optimize
	# //?!?
	@sudo docker-compose exec ${DOCKER} php artisan optimize
	# make swagger

# Генерация сваггера
swagger:
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan l5-swagger:generate --all

# Запуск обработки очереди
queue:
	@sudo docker-compose exec ${DOCKER} php artisan queue:work --stop-when-empty

# Обновление приложения
update:
	make composer
	make migrate
	make optimize

route-list:
	./vendor/bin/sail artisan route:list
# ______________________________________________________________________________________________________________________
# КОНСОЛЬНЫЕ КОМАНДЫ

command-optimize:
	./vendor/bin/sail artisan lh:optimize --telegram --log --cls

command-clear-cache:
	./vendor/bin/sail artisan lh:clear:cache --telegram --log --cls

command-cleanup-console-log:
	./vendor/bin/sail artisan lh:cleanup:console_log --telegram --log --cls

command-cleanup-http-log:
	./vendor/bin/sail artisan lh:cleanup:http_log --telegram --log --cls

command-cleanup-model-log:
	./vendor/bin/sail artisan lh:cleanup:model_log --telegram --log --cls

command-cleanup-query-log:
	./vendor/bin/sail artisan lh:cleanup:query_log --telegram --log --cls

command-cleanup-queue-log:
	./vendor/bin/sail artisan lh:cleanup:queue_log --telegram --log --cls

command-cleanup-route-log:
	./vendor/bin/sail artisan lh:cleanup:route_log --telegram --log --cls

command-cleanup-view-log:
	./vendor/bin/sail artisan lh:cleanup:view_log --telegram --log --cls

command-app-test:
	./vendor/bin/sail artisan app:test --telegram --log --cls

