# Windows VPS API Client

This package introduces APIv2 for Windows VPS services using PHP 7.x. PHP8.x version will follow shortly.

It's a complete rewrite of existing [winvps-api-php](https://github.com/FozzyHosting/winvps-api-php) with remaining API request/response format.

## Installation

`composer require fozzyhosting/winvps-php-client`


## Usage

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

The following plugin introduces main VPS entities you can use:

- Brands
- Jobs 
- Locations
- Machines 
- Products 
- Templates

All the classes are fully described in `src/v2/Entities/` directory. Description of response objects can be found in `src/v2/Schemas/` 


## Testing

Tests are implemented in `tests/` directory, and utilize PHPUnit and PHPStan dev dependencies.

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`
