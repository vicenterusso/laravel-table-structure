<?php

namespace VRusso\TableStructure\Traits;

use Illuminate\Support\Facades\Cache;

trait FieldsInfo
{

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

        $cache_key = 'TABLE.HASFIELD.' . strtoupper($table) . '.' . strtoupper($field);
        Cache::forget($cache_key);
        $all_fields = Cache::remember($cache_key, 5 * 60, function () use ($table) {
            return \Schema::getColumnListing($table);
        });

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

        $cache_key = 'TABLE.ALLFIELDS.' . strtoupper($table);
        Cache::forget($cache_key);
        $all_fields = Cache::remember($cache_key, 5 * 60, function () use ($table) {
            return \Schema::getColumnListing($table);
        });

        return $all_fields;

    }


    /**
     * Retorna todos os campos da tabela
     *
     * @return array
     */
    public static function getAllFieldsWithTypes(): array
    {

        $className = get_called_class();
        $table = with(new $className)->getTable();

        $cache_key = 'TABLE.ALLFIELDS.WITH.TYPES.' . strtoupper($table);
        Cache::forget($cache_key);
        $all_fields = Cache::remember($cache_key, 5 * 60, function () use ($table) {

            $fields = \Schema::getColumnListing($table);
            $return = [];
            foreach ($fields as $i => $field) {
                $return[$i]['field'] = $field;
                $return[$i]['type'] = \Schema::getColumnType($table, $field);
            }

            return $return;
        });

        return $all_fields;

    }


    /**
     * Retorna todos os campos de determinado tipo da tabela
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
