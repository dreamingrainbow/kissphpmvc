<?php
namespace Library\Data\Pdo;
use Library\Database;
class MySql extends \Pdo
{
     private $connection;
     private $host;
     private $port;
     private $username;
     private $password;
     private $schema;
     
     public function __construct( Database $database  )
     {
          $this->host = $database->getDatabase($database->getSelected())->host;
          $this->username = $database->getDatabase($database->getSelected())->username;
          $this->password = $database->getDatabase($database->getSelected())->password;
          $this->schema = $database->getDatabase($database->getSelected())->schema;
          parent::__construct("mysql:host={$this->host};dbname={$this->schema};", $this->username, $this->password );
          return $this;
     }
}