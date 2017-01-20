<?php
namespace Library\Validators;
class MemberExists
{
     public function isValid(  $str )
     {
          return ($str == '123') ? true : false;
     }
}

