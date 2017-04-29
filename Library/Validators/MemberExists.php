<?php
namespace Library\Validators;
class MemberExists
{
     public static function isValid(  $str )
     {
          return ($str == '123') ? true : false;
     }
}

