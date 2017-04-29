<?php
namespace Library\Filters;
class ToObject
{
    public static function filter($array)
    {
        $newObject = new \stdClass();
        foreach($array as $key => $value)
        {
            if(is_array($value))
            {
                $newObject->$key = ToObject::filter( $value );
            }
            else
            {
                $newObject->$key = $value;
            }
            
        }
        return $newObject;
    }
}