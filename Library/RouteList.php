<?php
namespace Library;
class RouteList
{
     private $_routeList;
     public function __construct()
     {
          $argCount =  func_num_args();
          if( $argCount != 0 )
          {
               $args = func_get_args();
               
               if(is_object($args[0]))
               {
                    /*Passed Object*/
                    /*Route Class object get added*/
                    if( $args[0] instanceof Route )
                    {
                         if(isset($args[0]->name))
                         {
                              $this->_routeList[$args[0]->name] = $args[0];
                         }
                         else
                         {
                              throw new \Exception('Invalid Route list configuration.');
                         }                         
                    }
                    /*If this is from the config it should fit this pattern*/
                    foreach( $args[0] as $routeName => $route )
                    {
                         $newRoute = new Route( $routeName, $route);
                         if($newRoute->isValid())
                         {
                              $this->_routeList[$newRoute->name] = $newRoute;
                         }
                         else
                         {
                              throw new \Exception('Invalid Route list configuration.');
                         }                        
                    }
               }
               elseif(is_array($args[0]))
               {
                    /*Passed Array*/
               }
          }
     }
     
     public function getRoute($name)
     {
          if(array_key_exists($name, $this->_routeList))
          {
               return $this->_routeList[$name];
          }
          return false;
     }
     
     public function __get( $name )
     {
          if($name == 'routes')
          {
               return $this->_routeList;
          }
     }
}