<?php
namespace Library\Filters;
class CamelCaseToUnderscore
{
    public static function filter( $word )
    {
        $word = preg_replace('#([A-Z\d]+)([A-Z][a-z])#','\1_\2', $word);
        $word = preg_replace('#([a-z\d])([A-Z])#', '\1_\2', $word);
        return strtr($word, '-', '_');
    }
}