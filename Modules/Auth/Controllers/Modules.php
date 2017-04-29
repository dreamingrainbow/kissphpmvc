<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Modules extends Auth
{
     use \Modules\Auth\Traits\GetModules;
     public function modules()
     {
          $this->modules = $this->getModules();
     }
}