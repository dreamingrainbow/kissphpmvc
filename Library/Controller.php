<?php
namespace Library;
class Controller
{
    private $_request;
    protected $_view;
    private $_renderView = true;
    public function __construct( Request $request )
    {
        if(!$request instanceof Request )
        {
            throw new \Exception('Invalid Request to Controller.');
        }
        $this->_request = $request;
    }
    
    protected function dispatch()
    {
        
    }
    
    public function setNoRenderView()
    {
        $this->_renderView = false;
    }
    
    private function setView( )
    {
        $route = $this->_request->getRoute();
        $moduleName = "{$route->module}";
        $controllerName = "{$route->controller}";
        $actionName = "{$route->action}";
        $className = DEFAULT_PATH . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . $actionName;
        $this->_view = $className;
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
        $className = DEFAULT_PATH . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . $partial . '.phtml';
        if(file_exists($className) && is_readable($className))
        {
            include( $className );
        }
        return false;
    }
    
    public function exec()
    {
        $route = $this->_request->getRoute();
        $action = $route->action;
        $this->dispatch();               
        $this->$action();
        if($this->_renderView)
        {
            $this->setView();                
        }         
    }
    
    public function __get( $name )
    {
        return $this->{$name};
    }
    
    public function __set( $name, $value )
    {    
        $this->{$name} = $value;       
    }
}