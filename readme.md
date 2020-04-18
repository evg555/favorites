### Приложение для сохранения закладок


#### Установка и настройка
Создать файл окружения

`cp .env.example .env`

Создать БД для приложения и указать настройки подключения к БД в файле .env

~~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=
~~~~

Установить все необходимые библиотеки и собрать фронтенд

`composer install`

`npm install`

`npm run dev`

Сгенерировать ключ приложения

`php artisan key:generate`

Запустить миграции

`php artisan migrate`

Запустить сервер (по необходимости)

`php artisan serve`

#### Используемые технологии

- Laravel 5.8
- PHP 7.3
- MySQL 8.0

