<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\PublicRoutes as PublicRoutesModel;
use Library\Route as Route;
class PublicRoutes extends Table
{     
     protected $_name = 'Test';
     
     public function createPublicRoutes()
     {
          $sql = 'create table PublicRoutes(
            `id` serial auto_increment,
            `route` tinytext NOT NULL
        )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function isPublicRoute( Route $route )
     {
          $sql = 'SELECT * FROM PublicRoutes where route=?';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array($route->name));
          $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
          return (count($results) > 0) ? true:false;
     }
     
     public function addPublicRoute( Route $route )
     {
          $publicRouteId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO PublicRoutes set route=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($route->name));
                    $publicRouteId = $this->connection()->lastInsertId();
                    $this->connection()->commit();
               }
               catch(\PDOExecption $e)
               {
                    $this->connection()->rollback();
                    print "Error!: " . $e->getMessage() . "</br>";
               }
          }
          catch( \PDOExecption $e )
          {
               print "Error!: " . $e->getMessage() . "</br>";
          }
          return $publicRouteId;
     }
     
     public function getPublicRoutes()
     {
          $sql = 'SELECT * FROM PublicRoutes';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
}