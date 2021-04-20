<?php

namespace VRusso\TableStructure;

use Illuminate\Support\Facades\Facade;

/**
 * @see \VRusso\TableStructure\TableStructure
 */
class TableStructureFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel_table_structure';
    }
}
