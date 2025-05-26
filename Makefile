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
	@sudo docker-compose down

# Создание контейнеров докера
build:
	@sudo docker-compose build

# Запуск контейнеров докера
up:
	@sudo docker-compose up -d

# Перезапуск контейнеров докера
restart:
	make down
	make up

# Вход в основной контейнер
sh:
	@sudo docker-compose exec ${DOCKER} sh

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
	@sudo docker-compose exec ${DOCKER} php artisan key:generate

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

# Оптимизация и кеширование приложения
optimize:
	@sudo chmod a+w -R ./config/*
	@sudo chmod a+w -R ./storage/*
	@sudo rm -f -R ./storage/logs/exceptions/*
	@sudo rm -f -R ./storage/tests/*
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan config:clear
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan cache:clear
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan clear-compiled
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan config:cache
	@sudo docker-compose exec -e XDEBUG_MODE=off ${DOCKER} php -dxdebug.mode=off artisan optimize
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

# ______________________________________________________________________________________________________________________
# КОНСОЛЬНЫЕ КОМАНДЫ

