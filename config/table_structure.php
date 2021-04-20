<?php

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
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'cache_connection' => env('TABLE_STRUCTURE_CONNECTION', 'redis'),

];
