<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Resources extends Auth
{
     public function resources()
     {
          $this->resources = [];
          foreach( scandir( dirname( dirname(dirname(__DIR__) ) )  . DIRECTORY_SEPARATOR . 'Public')  as $mod )
          {
               if($mod != '.' && $mod != '..')
               {
                    $this->resources[] = ['type'=>is_dir( dirname( dirname(dirname(__DIR__) ) )  . DIRECTORY_SEPARATOR . 'Public' . DIRECTORY_SEPARATOR .$mod ) ? 'Directory' : 'File', 'location'=>$mod];
               }
          }
          $this->resources;
     }
}