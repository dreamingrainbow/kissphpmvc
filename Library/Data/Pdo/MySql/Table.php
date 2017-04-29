<?php
namespace Library\Data\Pdo\MySql;
use Library\Database;
class Table
{     
     protected $_db;
     protected $_connection;
     protected $_name;
     
     public function __construct( $databases  )
     {         
          if(!$this->_db instanceof Database)
          {
               $this->_db = new Database( $databases, $this->_name );
          } 
          return $this->_db;
     }
     
     public function connection()
     {
          if(!isset($this->_connection))
          {
               $this->_connection = $this->_db->connect();
          }          
          return $this->_connection;
     }
}