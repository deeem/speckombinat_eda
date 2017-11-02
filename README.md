# Hexlet Student Environment HTTP

## About
Окружение для прохождения курсов на hexlet.io.

Содержит:
- php 7
- composer
- phpcs
- phpunit
- xdebug

## Requirements

- Docker

## Usage

HTTP доступ **127.0.0.1:8080**

Исходный код размещать в  `src`, тесты в `tests`.

При необходимости внести правки в Makefile:
- Если планируется использовать несколько копий данного окружения, в следующем нужно изменить имя контейнера _hexlet-http_ на новое
- Если будет использоваться дебагинг, необходимо в переменной `-e XDEBUG_CONFIG="remote_host=192.168.1.6"` изменить ip-адрес на текущий локальный

Использование Makefile:
- `make run` - запускает контейнер (аналог **docker run**)
- `make install` - composer устанавливает зависимости, указанные в _composer.json_ (аналог **composer install**)
- `make autoload` - аналог **composer dump-autoload**
- `make lint` - проверяет код на соответсвие стандарту _PSR-2_
- `make tests` - запускает тесты _phpunit_, с конфигурацией из _phpunit.xml.dist_

### Debug using PHPStorm

- в Google Chrome установить расширение [Xdebug Helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc)
- в PHPStorm `File` -> `Settings` -> `Language and Frameworks` -> `PHP` -> `Servers` -> `+` Указать `host: 127.0.0.1`, `port:8080`, замапить путь `src -> /app/src`
- в коде поставить точку останова
- в PHPStorm нажать на трубку `Run` -> `Start Listening for PHP Debug connection`
- в Google Chrome нажать на иконке установленного расширения и выбрать _Debug_
- перезагрузить страницу
