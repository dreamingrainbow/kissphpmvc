<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
use Library\Application;
use Library\Request;
class Dashboard extends Auth
{
     public function __construct(Application $app, Request &$request )
     {
          parent::__construct( $app, $request);
          if(isset($_SESSION['user-data']['role']))
          {
               switch($_SESSION['user-data']['role'])
               {
                    case '1':
                         $request->getRoute()->action = 'admin';
                         break;              
               }                         
          }

     }     
     
     public function dashboard()
     {
          
     }
     
     public function admin()
     {
          
     }
}