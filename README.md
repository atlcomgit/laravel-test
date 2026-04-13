https://www.youtube.com/watch?v=fGWh_uCqElU

Документация :
Laravel 12: https://laravel.com/docs/12.x/installation
Sail: https://laravel.com/docs/12.x/sail#main-co...
Laravel Breeze (док от Laravel 11, актуально): https://laravel.com/docs/11.x/starter-kits...
Spatie Laravel Permission v6: https://spatie.be/docs/laravel-permission/...

Создать/перейти в директорию проекта, запустить VScode
mkdir project1
cd project1
mkdir la12sail1
cd la12sail1
code .

Установка Laravel 12 в текущую (пустую) директорию
composer create-project laravel/laravel .

Установка Sail 
composer require laravel/sail --dev

Команда Опубликует docker-compose.yml файл Sail и изменит .env
    файл для подключения к службам Docker

php artisan sail:install
  выбрать базу например - mysql нажать Enter

Настройка Базы Данных в файле .env

DB_HOST=mysql # имя сервиса в yml файле

DB_DATABASE=la12sail1
DB_USERNAME=sail
DB_PASSWORD=password

(опционально, Для моих целей) Добавил phpmyadmin в docker-compose.yml, задал имена контейнерам, поменял версию PHP c 8.4 на 8.2

! Файл Редактируем, как в видео или
ссылка на описание урока 1,2
https://pastebin.com/CmvxFyia

services:
    laravel.test:
        build:
            context: './vendor/laravel/sail/runtimes/8.2' # поменял версию PHP с 8.4 на 8.2
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: 'sail-8.2/app' # поменял версию PHP с 8.4 на 8.2
        container_name: l12s_web #имя  контейнера
        extra_hosts:
'host.docker.internal:host-gateway'
        ports:
'${APP_PORT:-80}:80'
'${VITE_PORT:-5173}:${VITE_PORT:-5173}'
        environment:
            WWWUSER: '${WWWUSER}'
            LARAVEL_SAIL: 1
            XDEBUG_MODE: '${SAIL_XDEBUG_MODE:-off}'
            XDEBUG_CONFIG: '${SAIL_XDEBUG_CONFIG:-client_host=host.docker.internal}'
            IGNITION_LOCAL_SITES_PATH: '${PWD}'
        volumes:
'.:/var/www/html'
        networks:
sail
        depends_on:
mysql
    mysql:
        image: 'mysql/mysql-server:8.0'
        container_name: l12s_mysql  # имя контейнера
        ports:
'${FORWARD_DB_PORT:-3306}:3306'
        environment:
            MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ROOT_HOST: '%'
            MYSQL_DATABASE: '${DB_DATABASE}'
            MYSQL_USER: '${DB_USERNAME}'
            MYSQL_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ALLOW_EMPTY_PASSWORD: 1 # вход без пароля
        volumes:
'sail-mysql:/var/lib/mysql'
'./vendor/laravel/sail/database/mysql/create-testing-database.sh:/docker-entrypoint-initdb.d/10-create-testing-database.sh'
        networks:
sail
        healthcheck:
            test:
CMD
mysqladmin
ping
'-p${DB_PASSWORD}'
            retries: 3
            timeout: 5s
    phpmyadmin: # добавил сервис входа в phpmyadmin
        image: 'phpmyadmin:latest'
        container_name: l12s_phpmyadmin  # имя контейнера
        ports:
'8080:80'
        environment:
            PMA_HOST: mysql
            MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
        depends_on:
mysql
        networks:
sail

networks:
    sail:
        driver: bridge
volumes:
    sail-mysql:
        driver: local

команды - запустить, выгрузить контейнеры
./vendor/bin/sail up
Выход Ctrl+c
./vendor/bin/sail down

в
nano ~/.bashrc
   добавляем в конец строку
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
  нажмите Ctrl+O (сохранить), Enter, Ctrl+X (выхода)

Чтобы изменения вступили в силу
source ~/.bashrc

После alias будут работать:
sail up
sail up -d
sail down

Запустить миграцию
sail artisan migrate

Вход на сайт
http://localhost/
Вход в базу данных
http://localhost:8080
root
password
    или
sail
password

Определить NAME контейнеров можно командой 
docker-compose ps
вход в контейнер
docker exec -it l12s_web bash

Создаем символическую ссылку для доступа к папке storage
sail artisan storage:link

= Установка Breeze аутентификация и регистрация

composer require laravel/breeze --dev
sail artisan breeze:install

sail artisan migrate

Регистрация по тестовым данным:
Name: test
Login: test@gmail.com
Password: 12345678

= Установка spatie
composer require spatie/laravel-permission

Публикуем миграцию и config/permission.phpфайл конфигурации:
sail artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

spatie очистка
sail artisan optimize:clear
    или
sail artisan config:clear

spatie миграция
sail artisan migrate

в файл app/Models/User.php добавлено
use Spatie\Permission\Traits\HasRoles; // Добавлено
...
use HasFactory, Notifiable, HasRoles; // Добавлено HasRoles

Список команд
history

Стоп проект
sail down

php artisan storage:link
