<?php
namespace Library\Filters;
class StripAlpha
{
     public static function filter(  $str )
     {
          return preg_replace("/[^0-9]/", "", $str);
     }
}


