<?php
namespace Library;
class Module
{
    private $name = 'Library';
    
    public function __get( $name )
    {
        if( $name == 'name')
        {
            return $this->name;
        }
    }
}