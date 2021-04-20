# Laravel Table Structure

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vicenterusso/laravel-table-structure.svg?style=flat-square)](https://packagist.org/packages/vicenterusso/laravel-table-structure)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vicenterusso/laravel-table-structure/run-tests?label=tests)](https://github.com/vicenterusso/laravel-table-structure/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vicenterusso/laravel-table-structure/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vicenterusso/laravel-table-structure/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)

This package helps you to get information about your table fields adding only a `trait` to your model. You can also optionally cache the results.

## Installation

You can install the package via composer:

```bash
composer require vicenterusso/laravel_table_structure
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="VRusso\TableStructure\TableStructureServiceProvider" --tag="laravel_table_structure-config"
```

This is the contents of the published config file:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Enable Cache
    |--------------------------------------------------------------------------
    |
    | Enable or disable usage of cache for Schema queries.
    |
    */
    'use_cache' => false,

    /*
    |--------------------------------------------------------------------------
    | Cache Prefix
    |--------------------------------------------------------------------------
    |
    | Custom prefix for cache keys. Avoid empty values
    |
    */
    'cache_prefix' => env('TABLE_STRUCT_PREFIX', 'TABLE_STRUCT'),

];
```

## Usage

Insert the following trait to any model, and you can retrieve all info about the table fields

```php
# Add trait to model
use \VRusso\TableStructure\Traits\FieldsInfo;

# Call it anywhere
User::hasField('username'); 
//true/false

User::getAllFields();
//['username', 'password', ...]

User::getAllFieldsWithTypes();
//[
//    [
//    'field' => 'username',
//    'type' => 'string'
//    ],
//    (...)
//]

User::getAllFieldsWithTypeOf('integer');
//['id', ...]
```

## Credits

- [Vicente Russo](https://github.com/vicenterusso)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
