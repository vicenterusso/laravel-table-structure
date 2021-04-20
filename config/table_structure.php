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
    | Cache Prefix
    |--------------------------------------------------------------------------
    |
    | Custom prefix for cache keys. Avoid empty values
    |
    */
    'cache_prefix' => env('TABLE_STRUCT_PREFIX', 'TABLE_STRUCT'),

];
