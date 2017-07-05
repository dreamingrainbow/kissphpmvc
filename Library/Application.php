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
    private $cache = array();
    private $flashAlerts = array();
    private $apiOverride = false;
    
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
        return $this->gotoRouteAndExit( $this->request );
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
        $this->configs = new Config();
                
        return $this->configs;
    }
    
    public function getRouteList()
    {
        $this->routeList = new RouteList( $this->configs->Routes );
        return $this->routeList;
    }
    
    public function isOverride()
    {
        return $this->apiOverride ? true : false;
    }
    
    public function setAPIOverride()
    {
        $this->apiOverride = true;    
    }
    
    public function gotoRouteAndExit( Request $request )
    {
        $route = $request->getRoute();
        $moduleName = "{$route->module}";
        $controllerName = "{$route->controller}";        
        $className =  "Modules\\{$moduleName}\Controllers\\{$controllerName}";
        $controller = new $className( $this, $request );
        return $controller->exec();
    }
    
    public static function init()
    {
        $instance = self::getInstance();
        $instance->load();
    }

    public function __call($name, $args)
    {
        switch($name)
        {
            case 'setMessage':
                $this->flashAlerts[] = array('type'=>'primary','title'=>$args[0], 'message'=>$args[1]);
                return $this;
                break;            
            case 'setInfo':
                $this->flashAlerts[] = array('type'=>'info','title'=>$args[0], 'message'=>$args[1]);
                return $this;
                break;
            case 'setSuccess':
                $this->flashAlerts[] = array('type'=>'success','title'=>$args[0], 'message'=>$args[1]);
                $this->flashAlerts;
                return $this;
                break;
            case 'setWarning':
                $this->flashAlerts[] = array('type'=>'warning','title'=>$args[0], 'message'=>$args[1]);
                $this->flashAlerts;
                return $this;
                break;
            case 'setDanger':
                $this->flashAlerts[] = array('type'=>'danger','title'=>$args[0], 'message'=>$args[1]);
                $this->flashAlerts;
                return $this;
                break;
            case 'getAlerts':
                return $this->flashAlerts;
                break;
        }
    }
    
    public function __set($name, $value)
    {
        $this->cache[$name] = $value;
        return $this;
    }
    
    public function __get($name)
    {
        if(isset($this->cache[$name]))
        {
            return $this->cache[$name];
        }
    }
}