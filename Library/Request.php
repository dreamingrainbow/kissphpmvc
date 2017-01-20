<?php
namespace Library;
class Request
{
	private $method;
	private $url_elements;
	private $_route;
	private $_requestRouted = false;
	private $_valid = false;
	private $_error;
	private $_args;
	
	public function getCurrentRequest()
	{
		if(!isset($this->method))
		{
			$this->method = $_SERVER['REQUEST_METHOD'];
		}
		if(!isset($this->url_elements))
		{
			$cleanRequestURI = explode('?', $_SERVER['REQUEST_URI'] );
			if( substr( $cleanRequestURI[0] , (strlen($cleanRequestURI[0]) )-1) == '/' )
			{
				$cleanRequestURI[0] = substr( $cleanRequestURI[0] , 0, (strlen($cleanRequestURI[0]) )-1);
			}
			$this->url_elements = explode('/', $cleanRequestURI[0] );
		}
	}
	
	public function requestToRoute()
	{
		/*Get The Request*/
		if(!isset( $this->url_elements ) )
		{
			$this->getCurrentRequest();
		}
		/*Count The Route Elements*/
		$elementCount = count( $this->url_elements );
		
		/*Get All Active Routes*/
		$routeList = Application::getInstance()->getRouteList();
		/*Itirate through routes list to get viable routes*/
		$routes = array();
		foreach( $routeList->routes as $list )
		{
			/*Split the route Pattern To get Expanded Url Elements*/
			$routePatternArr = explode( '/', $list->routePattern );
			$routePatternSegments = array();
			foreach( $routePatternArr as $patternSegment )
			{
				if( strpos( $patternSegment , ':' ) !== false)
				{
					$segments =  explode(':', $patternSegment);
					if( strpos( $patternSegment , ':' ) != 0 )
					{
						$routePatternSegments[] = array('Label' => $segments[0]);
						$routePatternSegments[] = array('Label' => $segments[1],'Value' => $segments[1]);
					}
					else
					{
						$routePatternSegments[] = array('Label' => $segments[1],'Value' => $segments[1]);
					}
				}
				else
				{
					$routePatternSegments[] = array('Label'=>$patternSegment);	
				}
			}
			if($elementCount == 1 )
			{
				$elementCount++;
			}
			if( $elementCount == count($routePatternSegments))
			{
				$pass = false;
				foreach( $routePatternSegments as $i => $patternSegments )
				{
					
					if( !isset($patternSegments['Value']) && $patternSegments['Label']  )
					{
						if( isset($this->url_elements[$i]) && $this->url_elements[$i] == $patternSegments['Label'] )
						{
							$pass = true;
						}
						if( !isset($this->url_elements[$i]) && $patternSegments['Label'] == '')
						{
							$pass = true;
						}
					}					
				}
				if($pass)
				{
					$routes[] = $list;
				}				
			}
		}
		$routeCount = count($routes);
		if($routeCount == 0)
		{
			if(!isset($this->url_elements[1]) )
			{
				$primaryRoutePattern = explode( '/', $routeList->routes['Primary']->routePattern);
				if($primaryRoutePattern[1] == "")
				{
					$routes[] = $routeList->routes['Primary'];
				}
			}
		}
		$routeCount = count($routes);
		if( $routeCount != 1 )
		{
			throw new \Exception('Invalid Configuration. Cannot narrow route to one.');
		}
		$this->_route = array_pop($routes);
		$this->_requestRouted = true;
		$this->_valid = true;
		return $this;
	}
	
	public function getParams()
	{
		$routePatternArr = explode( '/' , $this->_route->routePattern );
		$routePatternSegments = array();
		foreach( $routePatternArr as $patternSegment )
		{
			if( strpos( $patternSegment , ':' ) !== false)
			{
				$segments =  explode(':', $patternSegment);
				if( strpos( $patternSegment , ':' ) != 0 )
				{
					$routePatternSegments[] = array('Label' => $segments[0]);
					$routePatternSegments[] = array('Value' => $segments[1]);
				}
				else
				{
					$routePatternSegments[] = array('Value' => $segments[1]);
				}
			}
			else
			{
				$routePatternSegments[] = array('Label'=>$patternSegment);	
			}
		}
		foreach ($routePatternSegments as $i => $patternSegment )
		{
			if(isset($patternSegment['Value']))
			{
				$this->_args[$patternSegment['Value']] = $this->url_elements[$i];
			}
		}
		return $this->_args;
	}
	
	public function getParam( $name )
	{
		if(!isset($this->_args))
		{
			$this->getParams();
		}
		if(is_array($this->_args) && array_key_exists( $name, $this->_args ))
		{
			return $this->_args[$name];
		}
		return false;
	}
	
	public function setRoute( Route $route, $params = NULL )
	{
		if(is_array($params))
		{
			foreach($params as $name => $value )
			{
				$this->_args[$name] = $value;
			}
		}
		$routePattern = explode( '/', $route->routePattern);
		$urlElements = array();
		foreach( $routePattern as $segments )
		{
			if( strpos($segments, ':') === false  )
			{
				$urlElements[] = $segments;
			}
			else
			{
				if( strpos($segments, ':') == 0 )
				{
					$urlElements[] = $this->getParam( substr($segments, 1) );
				}
				else
				{
					$segmentsExpanded = explode(':', $segments );
					$urlElements[] = $segmentsExpanded[0];
					$urlElements[] = $this->getParam( $segmentsExpanded[1] ); 
				}
			}
		}
		$this->_route = $route;
		$this->_requestRouted = true;
		$this->_valid = true;
		return $this;
	}
	
	public function getRoute()
	{
		if(!isset($this->_route))
		{
			$this->requestToRoute();		
		}
		return $this->_route;
	}
	
	public function isValid()
	{
		return $this->_valid;
	}
}
