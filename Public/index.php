<?php
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set('UTC');
define('DEFAULT_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR );
set_include_path( implode( PATH_SEPARATOR, array(
    DEFAULT_PATH . 'Library',
    get_include_path(),
)));
require_once( DEFAULT_PATH . 'Library\Autoload.php' );
spl_autoload_extensions('.php');
spl_autoload_register(array( new Library\Autoload(), 'LoadLibrary'), true);
use Library\Application as Application;
use Library\Exception as Exception;
try
{
    Application::init();
}
catch( \Exception $e )
{   
    throw new Exception( $e->getMessage(), $e->getCode(), $e->getPrevious() );
}