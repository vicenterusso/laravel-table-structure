<?php

namespace VRusso\TableStructure\Traits;

use Illuminate\Support\Facades\Cache;

trait FieldsInfo
{
    private static $use_cache;
    private static $cache_prefix;

    public static function bootFieldsInfo()
    {
        self::$use_cache = config('table_structure.use_cache');
        self::$cache_prefix = config('table_structure.cache_prefix');
    }

    /**
     * Informa se existe uma determinada coluna na tabela
     *
     * @param $field
     * @return bool
     */
    public static function hasField($field): bool
    {
        $className = get_called_class();
        $table = with(new $className)->getTable();

        $cache_key = self::$cache_prefix.'.HASFIELD.' . strtoupper($table) . '.' . strtoupper($field);
        $all_fields = self::$use_cache ? Cache::remember($cache_key, 5 * 60, function () use ($table) {
            return \Schema::getColumnListing($table);
        }) : \Schema::getColumnListing($table);

        return in_array($field, $all_fields);
    }

    /**
     * Retorna todos os campos da tabela
     *
     * @return array
     */
    public static function getAllFields(): array
    {
        $className = get_called_class();
        $table = with(new $className)->getTable();
        $cache_key = self::$cache_prefix.'.ALLFIELDS.' . strtoupper($table);

        return self::$use_cache ? Cache::remember($cache_key, 5 * 60, function () use ($table) {
            return \Schema::getColumnListing($table);
        }) : \Schema::getColumnListing($table);
    }

    /**
     * Return all fields of table
     *
     * @return array
     */
    public static function getAllFieldsWithTypes(): array
    {
        $className = get_called_class();
        $table = with(new $className)->getTable();

        $cache_key = self::$cache_prefix.'.ALLFIELDS.WITH.TYPES.' . strtoupper($table);

        return self::$use_cache ? Cache::remember($cache_key, 5 * 60, function () use ($table) {
            return self::getArrayTableInfo($table);
        }) : self::getArrayTableInfo($table);
    }

    private static function getArrayTableInfo($table) : array
    {
        $fields = \Schema::getColumnListing($table);
        $return = [];
        foreach ($fields as $i => $field) {
            $return[$i]['field'] = $field;
            $return[$i]['type'] = \Schema::getColumnType($table, $field);
        }
    }

    /**
     * Return all fields of type 'field_type'
     *
     * @return array
     */
    public static function getAllFieldsWithTypeOf($field_type): array
    {
        $all_fields = self::getAllFieldsWithTypes();
        $fields = [];
        foreach ($all_fields as $field) {
            if ($field['type'] == $field_type) {
                $fields[] = $field['field'];
            }
        }

        return $fields;
    }
}
