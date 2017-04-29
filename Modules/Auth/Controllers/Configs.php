<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Configs extends Auth
{
     public function configs()
     {
          $this->configs = $this->getInstance()->getConfigs();
     }
}