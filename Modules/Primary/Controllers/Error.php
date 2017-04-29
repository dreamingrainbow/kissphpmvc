<?php
namespace Modules\Primary\Controllers;
class Error extends \Library\Controller
{
    protected $_type;
    protected $_code;
    protected $_messages = array();
    
    public function Error()
    {
        
    }
    
    public function Exception()
    {
        
    }
    
    public function getMessages()
    {
        return $this->_messages;
    }
}