# Afosto Monolog Adapter

Send diagnostic information about your Afosto integration to the Afosto logging system using Monolog.

Requires the [Afosto API client](https://github.com/afosto/api-client) for connections.

## Quick Start

Add the Monolog adapter using Composer:
```bash
composer require afosto/monolog
```

Configure the Afosto API Client:
```php
\Afosto\ApiClient\App::run($storage, $oauthClientId, $oauthClientSecret);
```

Add the handler to monolog:
```php
// Create your Monolog instance
$logger = new \Monolog\Logger('afostologger');

// Create the Afosto handler and set the corresponding formatter
$handler = new \Afosto\Monolog\AfostoHandler();
$handler->setFormatter(new \Afosto\Monolog\AfostoFormatter());

// Add the handler to Monolog
$logger->pushHandler($handler);
```

## License
Copyright 2016 Afosto Saas B.V.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
or implied. See the License for the specific language governing
permissions and limitations under the License.