# lara-ore-request-log

[![Build Status](https://travis-ci.org/railken/lara-ore-request-logger.svg?branch=master)](https://travis-ci.org/railken/lara-ore-request-logger)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A laravel package to save all incoming requests within the database

# Requirements

PHP 7.1 and later.

This package [laravel/scout](https://github.com/laravel/scout) is required.

## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/lara-ore-request-logger
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\RequestLoggerServiceProvider" --tag="migrations"
```

After the migration has been published you can create the migration-table by running the migrations:

```bash
php artisan migrate
```
You can publish the config-file with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\RequestLoggerServiceProvider" --tag="config"
```

## RequestLoguration
```php

return [

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    | This is the table used to save logs to the database
    |
    */
    'table' => 'ore_request_logs',
];
```