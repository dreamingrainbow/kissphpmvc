<?php
namespace Modules\Auth\Controllers;
use Library\Controller;
use Library\Request as Request;
use Library\Application as Application;
use Library\Route as Route;
use Modules\Auth\Data\Model\User as AuthUserModel;
class Auth extends Controller
{
    protected $userSession = [];
    private $requestedRoute;
    private $authenticated = false;
    protected $user;
    public function __construct(Application $app, Request &$request )
    {
        parent::__construct( $app, $request);
        if(!isset($this->userSession['user-data']))
        {
            if(!isset($_SESSION['user-data']))
            {
                session_name('user-data');
                session_start();
                $_SESSION['user-data']['date'] = date('m/j/Y');
                $_SESSION['user-data']['app_instance_id'] = $app->getGUID();
                $_SESSION['user-data']['requestedRoute']  = $this->getRequest()->getRoute();
            }
            //exit();
            $this->userSession['user-data'] = $_SESSION['user-data'];
        }
        if(isset($this->userSession['user-data']))
        {
            if(isset($this->userSession['user-data']['authenticated']) && $this->userSession['user-data']['authenticated'] )
            {
                $this->authenticated = true;
                $this->user = $this->getModel('User','Auth');
                $this->user->id = $this->userSession['user-data']['id'];
                $this->user->role = $this->userSession['user-data']['role'];
            }
        }
        $this->requestedRoute = $this->getRequest()->getRoute();
        
         
        if(!$this->isAllowed())
        {
            if($this->requestedRoute != $this->_instance->getRouteList()->routes['LogIn']  && $this->requestedRoute != $this->_instance->getRouteList()->routes['AuthenticateUserByAuthForm'])
            {
                if(!$this->authenticated)
                {
                    $this->getRequest()->setRoute($this->_instance->getRouteList()->routes['LogIn']);
                }
                else
                {
                    return $this->permissionDenied();
                }                
            }

        }
        if($this->authenticated && ($this->requestedRoute == $this->_instance->getRouteList()->routes['LogIn']  || $this->requestedRoute == $this->_instance->getRouteList()->routes['AuthenticateUserByAuthForm']))
        {
            if( isset($_SESSION['user-data']))
            {
                session_unset($_SESSION['user-data']);
            }
            unset($this->userSession);
        }
    }
    
    public function isAllowed()
    {
        if($this->_instance->getRouteList()->routes['AuthenticateUserByAuthForm'] == $this->getRequest()->getRoute())
        {
            return true;
        }
        if($this->_instance->getRouteList()->routes['LogIn'] == $this->getRequest()->getRoute())
        {
            return true;
        }
        if($this->_instance->getRouteList()->routes['LogOut'] == $this->getRequest()->getRoute())
        {
            return true;
        }
        
        if( $this->isPublicRoute() )
        {
            return true;      
        }
        $_roles = $this->getTable('Roles','Auth')->getRoles();
        /*TODO Check If Current Route is a private route where users have permission to route.*/        
        $roles = [];
        foreach($_roles as $_role)
        {
           $roles[$_role['id']] = $_role['role'];
        }
        if(isset($this->userSession['user-data']['role']) && array_key_exists($this->userSession['user-data']['role'], $roles))
        {            
            return $this->isAllowedRoute();
        }
        return false;
    }
    
    public function isPublicRoute(Route $route = NULL)
    {
        if(!isset($route))
        {
            $route = $this->getRequest()->getRoute();
        }
        $routeName = array_search( $route, $this->_instance->getRouteList()->routes);
        if($routeName !== false)
        {
            return $this->getTable('PublicRoutes','Auth')->isPublicRoute( $route );
        }
        return false;
    }
    
    public function isPrivateRoute(Route $route = NULL)
    {
        if(!isset($route))
        {
            $route = $this->getRequest()->getRoute();
        }
        $routeName = array_search( $route, $this->_instance->getRouteList()->routes);
        if($routeName !== false)
        {
            return $this->getTable('PrivateRoutes','Auth')->isPrivateRoute( $route );
        }
        return false;
    }
    
    public function isAllowedRoute( Route $route = NULL, AuthUserModel $user = NULL)
    {
        if(!$route instanceof Route)
        {
            $route = $this->getRequest()->getRoute();
        }        
        if(!$user instanceof AuthUserModel)
        {
            if(!isset($this->userSession['user-data']['role']))
            {
                return false;
            }
            $user = $this->getModel('User','Auth');
            $user->id = $this->userSession['user-data']['id'];
            $user->role = $this->userSession['user-data']['role'];
        }        
        
        if(array_search($route, $this->_instance->getRouteList()->routes) !== false)
        {
            $table = $this->getTable('PrivateRoutes','Auth');
            if($table->isPrivateRoute( $route ) && $table->isAllowedRoute( $user, $route ))
            {
                return true;
            }
        }
        return false;
    }
    
    public function authenticate()
    {
        $this->user = $this->getModel('User','Auth');
        

        if(!isset($_POST['username']) || $_POST['username'] == '')
        {
            return false;
        }
        
        if($_POST['username'] != 'dreamingrainbow')
        {
            return false;
        }

        /*
          if (password_verify('rasmuslerdorf', $hash))
          {
               echo 'Password is valid!';
          }
          else
          {
               echo 'Invalid password.';
          }
        */
        $this->user->id = 2;
        $this->user->role = 1;
        $this->user->active = 1;
        $this->user->first_name = 'Michael';
        $this->user->last_name = 'Dennis';
        
        $this->userSession['user-data'] = array_merge($this->userSession['user-data'] ,get_object_vars($this->user));
        $_SESSION['user-data'] = $this->userSession['user-data'];
        return true;
    }

    public function logIn()
    {
        $this->getRequest()->setRoute( $this->_instance->getRouteList()->routes['AuthenticateUserByAuthForm'] );
        return $this->gotoRouteAndExit( $this->getRequest());
    }
    
    public function authenticateUserByApiKey()
    {
        return true;
    }
    
    public function authenticateUserByAuthForm()
    {        
        if(isset($_POST['authenticate']) && $_POST['authenticate'] == 'LogIn')
        {            
            if($this->authenticate())
            {
                $_SESSION['user-data']['authenticated'] = true;
                if($this->userSession['user-data']['requestedRoute'] == $this->_instance->getRouteList()->routes['LogIn'] )
                {
                    $this->getRequest()->setRoute($this->_instance->getRouteList()->routes['Primary'] );
                }
                else
                {
                    $this->getRequest()->setRoute($this->userSession['user-data']['requestedRoute']);
                }                
                return $this->gotoRouteAndExit($this->getRequest());
            }
        }        
    }
    
    public function isAuthenticated()
    {
        return $this->authenticated;
    }
    
    public function logOut()
    {        
        $this->setNoRenderView();
        if( isset($_SESSION['user-data']))
        {
            session_unset($_SESSION['user-data']);
        }
        unset($this->userSession);
        session_destroy();
        header('Location: /');
        exit();
    }       

        
}

