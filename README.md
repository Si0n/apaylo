# Laravel Custom Dependency Injection Configuration

This document explains how to configure dependency injection in a Laravel application using the example provided. The
configuration defines how specific dependencies (`AuthCredentials`, `ApiDomains`, and `LoggerInterface`) will be
resolved for the `EnvClientManager` class.

## Example Configuration

Here is an example of how to set up custom dependency injection in your Laravel application (put this in AppServiceProvider (replace with your own configurations)):

```php
<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use Psr\Log\LoggerInterface;
use Illuminate\Log\LogManager;
use App\Services\AuthCredentials;
use App\Services\ApiDomains;
use App\Enums\Channel;
use App\Client\EnvClientManager;

// Binding AuthCredentials
$this->app
    ->when(EnvClientManager::class)
    ->needs(AuthCredentials::class)
    ->give(function (Application $application) {
        /** @var ConfigContract $config */
        $config = $application->get(ConfigContract::class);

        return new AuthCredentials(
            apiKey: $config->get('services.apaylo.credentials.api_key'),
            sharedSecret: $config->get('services.apaylo.credentials.shared_secret'),
        );
    });

// Binding ApiDomains
$this->app
    ->when(EnvClientManager::class)
    ->needs(ApiDomains::class)
    ->give(function (Application $application) {
        /** @var ConfigContract $config */
        $config = $application->get(ConfigContract::class);

        return new ApiDomains(domains: $config->get('services.apaylo.base_uri'));
    });

// Binding LoggerInterface
$this->app
    ->when(EnvClientManager::class)
    ->needs(LoggerInterface::class)
    ->give(function (Application $application) {
        return $application->get(LogManager::class)->channel(Channel::API);
    });
```

## Explanation

1. **AuthCredentials Binding**:
    - For the `EnvClientManager::class`, whenever it requires an instance of `AuthCredentials`, Laravel will resolve it
      using the provided closures.
    - The `apiKey` and `sharedSecret` values are retrieved from the `services.apaylo.credentials` configuration in the
      `config/services.php` file.

2. **ApiDomains Binding**:
    - Whenever the `EnvClientManager` class needs an instance of `ApiDomains`, the domain is fetched from the
      `services.apaylo.base_uri` configuration file and injected via the closure.

3. **LoggerInterface Binding**:
    - Whenever `EnvClientManager` needs a `LoggerInterface`, a specific log channel (`Channel::API`) is provided by
      fetching a configured `LogManager`.

## Configuration Example in `config/services.php`

Ensure that the configuration keys defined in the code above exist in your `config/services.php` file:

```php
use ApiIntegrations\Apaylo\Enum\ApiEnv;

return [
    'apaylo' => [
        'credentials' => [
            'api_key' => env('APAYLO_API_KEY'),
            'shared_secret' => env('APAYLO_SHARED_SECRET'),
        ],
        'base_uri' => [
            ApiEnv::ENV_1 => env('APAYLO_BASE_URI_ENV_1'),
            ApiEnv::ENV_2 => env('APAYLO_BASE_URI_ENV_2'),
            ApiEnv::ENV_3 => env('APAYLO_BASE_URI_ENV_3'),
        ],
    ],
];
```

## Usage

When the `EnvClientManager` is resolved via dependency injection, Laravel will automatically inject the configured
`AuthCredentials`, `ApiDomains`, and `LoggerInterface` instances based on the above bindings.

## Environment Variables

Make sure to set the following environment variables in your `.env` file for the configuration to work:

```env
APAYLO_API_KEY=<your_api_key>
APAYLO_SHARED_SECRET=<your_shared_secret>
APAYLO_BASE_URI_ENV_1=<base_uri_for_env_1>
APAYLO_BASE_URI_ENV_2=<base_uri_for_env_2>
APAYLO_BASE_URI_ENV_3=<base_uri_for_env_3>
```

## Reference

- [Laravel Service Container](https://laravel.com/docs/container)
- [Configuring Service Providers](https://laravel.com/docs/providers)