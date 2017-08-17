<?php
namespace Library;
use Library\Application;
class Controller
{
    private $_instance;
    private $_request;
    private $_db;
    protected $_view;
    private $_renderView = true;
    private $tables;
    private $models;
    public function __construct(Application $app, Request $request )
    {
        if(!$app instanceof Application )
        {
            throw new \Exception('Invalid initializer.');
        }
        if(!$request instanceof Request )
        {
            throw new \Exception('Invalid Request to Controller.');
        }
        $this->_instance = $app;
        $this->_request = $request;
    }
    
    protected function dispatch()
    {
        
    }
    
    public function setNoRenderView()
    {
        $this->_renderView = false;
    }
    
    private function setView()
    {
        $route = $this->_request->getRoute();
        $moduleName = "{$route->module}";
        $controllerName = "{$route->controller}";
        $actionName = "{$route->action}";
        $fileName = DEFAULT_PATH . 'Modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $actionName;
        $this->_view = $fileName;
        require_once($this->_view .'.phtml');
    }
    
    public function getRequest()
    {
        return $this->_request;
    }
    
    public function getPartial($partial, $module, $params = null)
    {
        if(isset($params) && is_array($params))
        {
            foreach( $params as $paramKey => $paramValue)
            {
                $this->{$paramKey} = $paramValue;
            }            
        }
        
        $className = DEFAULT_PATH . 'Modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . str_replace( '\\', '/' , $partial) . '.phtml';
        if(file_exists($className) && is_readable($className))
        {
            include( $className );
        }
        return false;
    }
    
    public function fileNotFound($msg = NULL)
    {
        if(isset($msg))
        {
            $this->errorMessage = $msg;
        }
        else
        {
            $this->errorMessage = 'Unable to load Resource please try again or contact support.';
        }
        
        $this->errorType = '404 Not Found';
        header("HTTP/1.0 404 Not Found");        
        $className = DEFAULT_PATH . 'Modules' . DIRECTORY_SEPARATOR . 'Primary' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR .'Error'. DIRECTORY_SEPARATOR . 'error.phtml';
        if(file_exists($className) && is_readable($className))
        {
            include( $className );
        }
        else
        {
            echo  '<h1>Not Found :: Resource Not Found</h1>';
        }        
        exit(404);
    }

    public function permissionDenied($msg = NULL)
    {
        if(isset($msg))
        {
            $this->errorMessage = $msg;
        }
        else
        {
            $this->errorMessage = 'Access to this resource has been restricted.';
        }
        
        $this->errorType = '403 Forbidden';
        header('HTTP/1.0 403 Forbidden');
        $fileName = DEFAULT_PATH . 'Modules' . DIRECTORY_SEPARATOR . 'Primary' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . 'Error' . DIRECTORY_SEPARATOR . 'error.phtml';
        if(file_exists($fileName) && is_readable($fileName))
        {
            include( $fileName );
        }
        else
        {
            echo  '<h1>Access Forbidden :: Permission Denied</h1>';
        }
        exit(403);
    }
    
    public function exec()
    {
        
        $this->dispatch(); 
        $route = $this->_request->getRoute();
        $action = $route->action;                      
        $this->$action();
        if($this->_renderView)
        {
            ob_start();
            $this->setView();
            $view = ob_get_contents();
            ob_end_clean();
            echo $view;            
        }
        exit();
    }
    
    public function __get( $name )
    {
        return $this->{$name};
    }
    
    public function __set( $name, $value )
    {
        $this->{$name} = $value;
        return $this;
    }
    
    public function Db()
    {
        if(!isset($this->_db))
        {
            if(func_num_args())
            {
                $this->_db = new Database( implode(',', func_get_args() ) );    
            }
            else
            {
                $this->_db = new Database( );
            }            
        }
        return $this->_db;
    }
    
    public function getTable($table, $module = 'Primary')
    {
        $instance = "Modules\\$module\Data\Tables\\$table";
        if(!isset($this->tables[$module][$table]) || !$this->tables[$module][$table] instanceof $instance )
        {
            
            $this->tables[$module][$table] = new $instance( $this->_instance->getConfigs()->Database );
        }
        return $this->tables[$module][$table];
    }
        
    public function getModel($model, $module = 'Primary')
    {
        $instance = "Modules\\$module\Data\Model\\$model";
        if(!isset($this->models[$module][$model]) || !$this->models[$module][$model] instanceof $instance )
        {            
            $this->models[$module][$model] =  new $instance();
        }
        return $this->models[$module][$model];
    }
    
    public function getController($controller, $module)
    {
        $r = new \Library\Request();        
        $c =  '\\Modules\\' . $module.  '\\Controllers\\' . $controller;        
        $v = new $c($this->getInstance(), $r);
        return $v;
    }
    
    public function __call($name, $arguments)
    {
        if($name == 'gotoRouteAndExit')
        {
            return $this->getInstance()->gotoRouteAndExit($arguments[0]);
        }
    }
    
    public function renderAsJSON($arr)
    {
        header('Content-Type: application/json');
        echo json_encode($arr);
        exit();
    }
    
    public function getInstance()
    {
        return $this->_instance;        
    }
}