<?php
namespace Library;
class Route
{
	private $_name;
	private $_module;
	private $_controller;
	private $_action;
	private $_routePattern;
	private $_args;
	
    public function __construct(  )
    {
		$argCount =  func_num_args();
		if( $argCount != 0 )
		{
			if( $argCount != 2 )
			{
				throw new \Exception('Invalid Number of Route Arguments.');
			}
			$args = func_get_args();
			$this->_name = $args[0];
			if (is_object($args[1]))
			{
				$this->_module = $args[1]->Module;
				$this->_controller = $args[1]->Controller;
				$this->_action = $args[1]->Action;
				$this->_routePattern = $args[1]->Route->Pattern;				
			}
			elseif( is_array( $args[1] ) )
			{
				$this->_module = $args[1]['Module'];
				$this->_controller = $args[1]['Controller'];
				$this->_action = $args[1]['Action'];
				$this->_routePattern = $args[1]['Route']['Pattern'];
			}
			else
			{
				throw new \Exception('Invalid Route Arguments.');
			}
		}
    }
    
	public function isValid()
	{
		if( !isset( $this->_name) )
		{
			return false;
		}
		if( !isset( $this->_module) )
		{
			return false;
		}
		if( !isset( $this->_controller ) )
		{
			return false;
		}
		if( !isset( $this->_action) )
		{
			return false;
		}
		if( !isset( $this->_routePattern ) )
		{
			return false;
		}
		return true;
	}
	
	public function __get( $name )
	{
		if($name == 'name')
		{
			return $this->_name;
		}
		if($name == 'module')
		{
			return $this->_module;
		}
		if($name == 'controller')
		{
			return $this->_controller;
		}
		if($name == 'action')
		{
			return $this->_action;
		}
		if($name == 'routePattern')
		{
			return $this->_routePattern;
		}
	}
	
    public static function getInstance() 
    {
        if( !self::$_instance instanceof Route )
        {
            self::$_instance = new Route();
        }
        return self::$_instance;
    }
}

