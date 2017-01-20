<?php
namespace Library;
class Application 
{
   
    private $GUID;
    private $configs;
    private $routeList;
    private $route;
    private $request;
    private static $_instance;

    public static function getInstance() 
    {
        if( !self::$_instance instanceof Application )
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    protected function load()
    {
        $this->getGUID();
        /*Setup the Application Basics*/
        $this->getConfigs();
        $this->request = new Request();
        $this->request->getCurrentRequest();
        $this->request->requestToRoute();
        if( !$this->request->isValid() )
        {
            $this->fileNotFound();
        }        
        $this->gotoRouteAndExit( $this->request );
    }
    
    protected function setGUID()
    {
        if( !isset($this->GUID) )
            $this->GUID = uniqid('', true);    
    }
    
    public function getGUID()
    {
        if($this->GUID === false || is_null($this->GUID))
        {
            $this->setGUID();
        }
        return $this->GUID;
    }
      
    public function getConfigs()
    {
        if(!isset( $this->configs ) || !$this->configs instanceof Config )
        {
            $this->configs = new Config();
        }        
        return $this->configs;
    }
    
    public function getRouteList()
    {
        if(!isset( $this->routeList ) || !$this->routeList instanceof RouteList )
        {
            $this->routeList = new RouteList( $this->configs->Routes );
        }
        return $this->routeList;
    }
    
    public function fileNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        exit( );
    }

    public function permissionDenied()
    {
        header('HTTP/1.0 403 Forbidden');
        exit();
    }
    
    public function gotoRouteAndExit( Request $request )
    {
        //$request->getParams();
        //var_dump($request->getParam('z'));
        $route = $request->getRoute();
        $moduleName = "{$route->module}";
        $controllerName = "{$route->controller}";        
        $className = DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . "$moduleName" . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName;        
        $controller = new $className( $request );
        $controller->exec();
        exit();
    }
    
    public static function init()
    {
        $instance = self::getInstance();
        $instance->load();
    }
}