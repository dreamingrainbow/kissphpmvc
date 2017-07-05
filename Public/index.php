<?php
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(E_ALL);
set_time_limit(60);
date_default_timezone_set('UTC');
define('DEFAULT_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR );
set_include_path( implode( PATH_SEPARATOR, array(
    DEFAULT_PATH . 'Library',
    get_include_path(),
)));
 
function debug()
{
    foreach(func_get_args() as $arg)
    {
        echo '<pre>';
        var_dump($arg);
        echo '</pre>';
    }
}

function json_encode_recursive(array $arr)
{
    $en = [];
    foreach($arr as $k => $v)
    {
        if(is_array($v))
        {
            $en[$k] = json_encode_recursive($v);
        }
        else
        {
            $en[$k] = json_encode($v);
        }        
    }
    return json_encode($en);
}

function json_decode_recursive($json)
{
    $results = [];
    $de = json_decode($json);
    foreach($de as $k => $arr)
    {
        $decoded = json_decode($arr);
        if(is_object($decoded))
        {
            $results[$k] = json_decode_recursive($arr);
        }
        else
        {
            $results[$k] = $decoded;
        }        
    }
    return $results;
}
require_once( DEFAULT_PATH . 'Library'.DIRECTORY_SEPARATOR.'Autoload.php' );
spl_autoload_extensions('.php');
spl_autoload_register(array( new Library\Autoload(), 'LoadLibrary'), true);
use Library\Application;
Application::init();
