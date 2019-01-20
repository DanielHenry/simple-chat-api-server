# Simple Chat API Server

[![PHP](https://img.shields.io/badge/php-7.1.16-blue.svg?style=flat-square)](http://php.net/releases/7_1_16.php)
[![PHP](https://img.shields.io/badge/laravel-5.4-blue.svg?style=flat-square)](https://laravel.com/docs/5.4/releases)
[![Build Status](https://travis-ci.org/DanielHenry/simple-chat-api-server.svg?branch=master)](https://travis-ci.org/DanielHenry/simple-chat-api-server)

Laravel server and Laravel Echo Server to deliver chat API.

## System Requirements

The following are required to function properly.

*   PHP 7.1.16
*   Composer 1.5.1
*   Laravel 5.4
*   MySQL 5.7

## Getting Started

First, we need to install all dependencies via composer. Make sure to run composer in project root directory after you clone this project.

``` shell

$   composer install

```

Next, we need to copy .env.example to .env file.

``` shell

$   cp .env.example .env

```

After that, generate APP_KEY with key generator artisan command.

``` shell

$   php artisan key:generate

```

Before you run database migrations, you must add a database to your MySQL Server. In my case, i will add and use database named `test`. If you use `test`, make sure you don't have database named `test`. You can make your own database configuration in `.env` file in variables whose prefix are `DB_`.

``` shell

$   mysql -e 'CREATE DATABASE IF NOT EXISTS test;'

```

After that, you can run database migration.

``` shell

$   php artisan migrate

```

Setting your environment for APP_URL variable with your own url and for other environment variables in `.env` file.

You can run this project from `php artisan serve` command and bind port 80,

``` shell

$   php artisan serve

```

or run it by http server like Apache or Nginx.

Finally, you can access the API in your server/computer from other devices.

## List of API

This is the list of API. For API details, you can visit this repo's [wiki](https://github.com/DanielHenry/simple-chat-api-server/wiki).

*   [HTTP POST] {url}/api/send-message
*   [HTTP POST] {url}/api/get-messages
*   [WebSocket] {Socket.io server URL}/apps/your-app-id/events?auth_key={authkey}