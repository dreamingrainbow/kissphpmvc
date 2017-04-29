<?php
namespace Library;
class Config
{
    private $iniLocation;
    private $_configIni = array();
    protected $_Production;
    protected $_Routes;
    
    public function __construct( )
    {
        $argCount = func_num_args();
        if( $argCount != 0 )
        {
            if( $argCount == 1)
            {
                $args = func_get_args();
                $this->iniLocation = array_shift($args);
            }
            elseif ( $argCount == 2)
            {
                $args = func_get_args();
                if(!is_bool( $args[1]))
                {
                    throw new \Exception('The supplied configuration arguments are invalid.', 500);
                }
                if( $args[1] === true )
                {
                    $this->iniLocation = DEFAULT_PATH . array_shift($args);
                }
                else
                {
                    $this->iniLocation = array_shift($args);
                }
                
            }
        }
        else
        {
            $this->iniLocation = DEFAULT_PATH . 'Config/Config.ini';
        }
        
        $this->load();
        return true;
    }
    
    public function __get( $name )
    {
        if($name == 'Production')
        {
            if(array_key_exists('Production', $this->_configIni))
            {
                $this->_Production = Filters\ToObject::filter( $this->_configIni['Production'] );
            }
            return $this->_Production;
        }
        elseif($name == 'Routes')
        {
            if(array_key_exists('Routes', $this->_configIni))
            {
                $this->_Routes = Filters\ToObject::filter( $this->_configIni['Routes'] );
            }
            return $this->_Routes;
        }
        elseif($name == 'Database')
        {
            if(array_key_exists('Database', $this->_configIni))
            {
                $this->_Database = Filters\ToObject::filter( $this->_configIni['Database'] );
            }
            return $this->_Database;
        }
    }
    
    private function load()
    {
        
        if( file_exists( $this->iniLocation ) && is_readable( $this->iniLocation ) )
        {
            $ini = parse_ini_file( $this->iniLocation, true);
        }
        else
        {
            throw new \Exception('Unable to load or locate the configuration file {Config.ini}.');
        }
        if($ini === false)
        {
            throw new \Exception( 'Unable to load Config.ini file.');
        }        
        foreach ( $ini as $iniHeaders => $iniDirectives )
        {
            $this->splitDirectives( $iniHeaders, $iniDirectives );
        }
        return $this;
    }
    
    private function nest($iniHeaders, $nestArray, $value)
    {
        $holding;
        $count = count($nestArray);           
        while(count($nestArray) > 0)
        {
            if(empty($holding))
            {
                $el = array_pop($nestArray);
                $holding = array($el => $value);
            }
            
            $nEl = array_pop($nestArray);
            $holding = array( $nEl => $holding );
        }
        $holding = array($iniHeaders => $holding );
        $this->_configIni = array_merge_recursive( $this->_configIni, $holding);
    }
    
    private function splitDirectives( $iniHeaders , $iniDirectives )
    {
        foreach( $iniDirectives as $Directives => $value )
        {        
            $nestArray = explode('.', $Directives);            
            $this->nest($iniHeaders, $nestArray, $value);            
        }        
    }
}
