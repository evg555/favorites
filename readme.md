### Приложение для сохранения закладок


#### Установка и настройка
Установить все необходимые библиотеки и собрать фронтенд

`composer install`

`npm install`

`npm run dev`

Создать БД для приложения и указать настройки подключения к БД в файле .env

~~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=
~~~~

Запустить миграции

`php artisan migrate`

Запустить сервер (по необходимости)

`php artisan serve`

#### Используемые технологии

- Laravel 5.8
- PHP 7.3
- MySQL 8.0

