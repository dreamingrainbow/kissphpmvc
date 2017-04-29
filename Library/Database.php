<?php
namespace Library;
use Library\Data\Pdo\MySql;
class Database
{
     private $_dbs = [];
     private $_selected;
     private $_connection;
     public function __construct( $databases, $connectionName  )
     {          
          $this->_dbs = $databases;

          $argCount =  func_num_args();
          if( $argCount != 0 )
          {
               //check for database path name
               $args = func_get_args();
               if(array_key_exists($connectionName, get_object_vars( $this->_dbs ) ))
               {
                    $this->_selected = $connectionName;
                    return $this;
               }
               throw new \Exception('Unable to load database route.');
          }
          else
          {
               if(!property_exists($this->_dbs, 'Primary' ))
               {
                    throw new \Exception('Unable to load Primary database route.');
               }
               $this->_selected = 'Primary';
          }         
          return $this;
     }
     
     public function getSelected()
     {
          return $this->_selected;
     }
     
     public function connect()
     {          
          $driver = $this->_dbs->{$this->getSelected()}->driver;
          if(!isset($this->_connection[$this->getSelected()]))
          {
               switch(strtolower($driver))
               {
                    /*TODO: Add other dabase drivers here*/
                    case 'mysql':
                    default:                    
                         
                              $this->_connection[$this->getSelected()] =  new MySql($this);                         
                         break;
               }
          }   
          return $this->_connection[$this->getSelected()];
     }
     
     public function createDb($dbName)
     {
          return $this->connect()->exec(sprintf('create database %s', $dbName ) );
     }
     
     public function getDatabase()
     {
          if(property_exists( $this->_dbs, $this->_selected ))
          {
               return $this->_dbs->{$this->_selected};
          }
          return false;
     }
}