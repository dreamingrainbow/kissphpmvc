<?php
namespace Modules\Auth\Traits;
trait GetModules
{
     public function getModules()
     {
          $this->modules = [];
          foreach(scandir( dirname(dirname(__DIR__)) ) as $mod )
          {               
               if($mod != '.' && $mod != '..')
               {
                    if(is_dir( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR.$mod ))
                    {
                         $this->modules[] = $mod;                         
                    }
               }
          }
          return $this->modules;
     }
}