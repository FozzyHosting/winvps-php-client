Данный PHP пакет есть ничто иное, как клиент для Reseller API v2 сервиса WinVPS (winvps.fozzy.com).

Ранее уже был подобный [PHP пакет](https://github.com/FozzyHosting/winvps-api-php), созданный на основе кодогенерации и Swagger документации. Его принято считать устаревшим.

# Установка и примеры использования

Чтобы установить пакет в свой проект, следует выполнить команду:

`composer require fozzy-hosting/winvps-php-client`

После установки пакета мы можем создать экземпляр клиента и выполнять запросы следующим образом:

```php
<?php

use Fozzy\WinVPS\Api\Client;

// Create API client
$client = Client::make('api-key');

// Returns list of all templates available for new machines
$templates = $client->templates()->list();

// View single Job details
$jobDetails = $client->jobs()->getById($jobId);

// Send single command which does not need additional options
$jobs = $client->machines()->sendCommandByName($machineName, 'restart');
```

# Подробности

Клиент позволяет управлять 6-ю сущностями:

* Brands
* Jobs
* Locations
* Machines
* Products
* Templates

Описание методов сущностей основано на документации PHPDoc. Классы сущностей находятся в директории `src/v2/Entities/`. Все сущности унаследованы от класса Entity.

Методы в большинстве случаев возвращают объекты или массивы, основанные на классах в директории `src/v2/Schemas/`. Реализован своего рода "_data mapping_".

## Зависимости

В пакете есть зависимости:

```json
"require": {
    "php": "7.*",
    "guzzlehttp/guzzle": "^7.4"
}
```

## Dev зависимости

Также есть зависимости для окружения разработчика:

```json
"require-dev": {
    "phpunit/phpunit": "^9.5",
    "phpstan/phpstan": "^1.4",
    "squizlabs/php_codesniffer": "^3.6"
}
```

Тесты находятся в директории `tests/`. Тесты используют файл конфигурации `phpunit.xml`.

Чтобы выполнить тесты, выполните команду в директории пакета:

`./vendor/bin/phpunit`

Статический анализатор кода (**_phpstan_**) использует файл конфигурации `phpstan.neon`.

Чтобы выполнить анализ кода, выполните команду в директории проекта:

`./vendor/bin/phpstan analyse`

CodeSniffer (**_phpcs_**) использует файл конфигурации `phpcs.xml.dist`.

Чтобы выполнить проверку стандартов, выполните команду в директории проекта:

`./vendor/bin/phpcs`
