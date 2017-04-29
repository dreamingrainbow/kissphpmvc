<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Routes extends Auth
{
     use \Modules\Auth\Traits\GetModules;
     public function routes()
     {
          $this->standardRoutes = $this->getInstance()->getRouteList()->routes;
          $this->publicRoutes = $this->getTable('PublicRoutes','Auth')->getPublicRoutes();
          $this->privateRoutes = $this->getTable('PrivateRoutes','Auth')->getPrivateRoutes();
          $this->modules = $this->getModules();
     }

     public function getRoutes()
     {
          $this->setNoRenderView();
          
     }
     
     public function add()
     {
          
     }
     
     public function delete()
     {
          
     }
     
     public function enable()
     {
          
     }
     
     public function disable()
     {
          
     } 
}