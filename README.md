# Easier Laravel integration for rocket-code/shopify

This packages allows for a better integration of [rocket-code/shopify](https://github.com/joshrps/laravel-shopify-API-wrapper).

## Benefits
By using this package you get these added values:

- Auto discovery (Laravel 5.5 or higher) - no need to manually add any service provider
- Configuration in env file
- Allow the service to be used in dependency injection
- Allow usage as [real time facade](https://twitter.com/taylorotwell/status/814944242158149632) (Laravel 5.4 or higher)

## Installation

You can install the package via composer:

```bash
composer require boaideas/laravel-shopify
```

If you're installing the package on Laravel 5.5 or higher, you're done (The package uses Laravel's auto package discovery).

If you're using Laravel 5.4 or less, add the `BOAIdeas\Shopify\ShopifyServiceProvider` service provider to your providers array:

```php
// config/app.php

'providers' => [
    ...
    BOAIdeas\Shopify\ShopifyServiceProvider::class,
];
```

## Configuration

Now, by default, the package will look for the following values in your .env file:
```
// .env

SHOPIFY_KEY=YourAppApiKey
SHOPIFY_SECRET=YourAppSecret
SHOPIFY_DOMAIN=YourShopDomain (for private apps)
SHOPIFY_TOKEN=YourToken
```

If, for some reason, you want to change any of these settings, you can publish the config file with:

```bash
php artisan vendor:publish --provider="BOAIdeas\Shopify\ShopifyServiceProvider"
```

This is the content of the published config file:

```php
// config/shopify.php

return [
    'api_key'       => env('SHOPIFY_KEY'),
    'api_secret'    => env('SHOPIFY_SECRET'),
    'shop_domain'   => env('SHOPIFY_DOMAIN'),
    'access_token'  => env('SHOPIFY_TOKEN'),
];
```

## Usage

Once installed, you can use the service by either inject it to your methods or as a real time facade.
For more information about how to use the service, look at https://github.com/joshrps/laravel-shopify-API-wrapper.

### Dependency Injection
Now you can simply type hint the service in your method's arguments. For better readabilty, we prefer to import the full class name with a `use` statement, and aliasing it to Shopify while we're at it.

```php
use RocketCode\Shopify\API as Shopify;

Route::get('/', function (Shopify $shopify) {

    $call = $shopify->call(
    [
        'URL' => 'products.json',
        'METHOD' => 'GET',
        'DATA' => [
            'limit' => 5,
            'published_status' => 'any'
        ]
    ]);

});
```

### Facade
Now you can use Laravel's [on the fly facades](https://twitter.com/taylorotwell/status/814944242158149632) feature to use the service "statically".

```php
use Facades\RocketCode\Shopify\API as ShopifyAPI;

Route::get('/', function () {

    $call = ShopifyAPI::call(
    [
        'URL' => 'products.json',
        'METHOD' => 'GET',
        'DATA' => [
            'limit' => 5,
            'published_status' => 'any'
        ]
    ]);

});
```

## Credits

- [Amos Shacham](https://github.com/amosmos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.