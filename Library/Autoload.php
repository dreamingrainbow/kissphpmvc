<?php
namespace Library;
class Autoload
{

    public static function autoload()
    {
        $cwd = dirname(__DIR__);
        spl_autoload_extensions('.php');
        spl_autoload_register(array($this, 'loadLibrary'), true);
    }
    
    public static function loadLibrary( $class )
    {
        if( file_exists( DEFAULT_PATH . str_replace('\\' , DIRECTORY_SEPARATOR , $class ). '.php' ) )
        {
            include( DEFAULT_PATH . str_replace('\\' , DIRECTORY_SEPARATOR , $class ). '.php' );
        }
        $classArr = explode( DIRECTORY_SEPARATOR, str_replace('\\' , DIRECTORY_SEPARATOR , $class ));
        $className = array_pop($classArr);
        $namespace = implode( DIRECTORY_SEPARATOR, $classArr );
        
        if( file_exists( DEFAULT_PATH . 'Library' . DIRECTORY_SEPARATOR . 'Custom' . DIRECTORY_SEPARATOR . $namespace . '.php' ) )
        {
            include( DEFAULT_PATH . 'Library' . DIRECTORY_SEPARATOR . 'Custom' . DIRECTORY_SEPARATOR . $namespace  . '.php' );
        }
        if(isset($classArr[1] ))
        if(file_exists( DEFAULT_PATH . 'Library' . DIRECTORY_SEPARATOR .  $namespace . DIRECTORY_SEPARATOR . $classArr[1] .'.php' ) )
        {
            include( DEFAULT_PATH . 'Library' . DIRECTORY_SEPARATOR .  $namespace . DIRECTORY_SEPARATOR . $classArr[1] .'.php');
        };
    }
    
}