<?php
namespace Modules\Auth\Data\Tables;
use Library\Route;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\PrivateRoutes as PrivateRoutesModel;
use Modules\Auth\Data\Model\User as AuthUserModel;
class PrivateRoutes extends Table
{     
     protected $_name = 'Test';
     
     public function createPrivateRoutes()
     {
          $sql = 'create table PrivateRoutes(
            `id` serial auto_increment,
            `route` varchar(56) NOT NULL UNIQUE
        )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function createPrivateRoutePermissions()
     {
          $sql = 'create table PrivateRoutePermissions(
            `id` serial auto_increment,
            `role`  tinytext NOT NULL,
            `route` tinytext NOT NULL
        )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function isPrivateRoute( Route $route )
     {
          $sql = 'SELECT * FROM PrivateRoutes WHERE route = ?';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array($route->name));
          $results = $sth->fetchAll(\PDO::FETCH_ASSOC);          
          return (count($results) > 0) ? true:false;
     }
     
     public function isAllowedRoute(AuthUserModel $user, Route $route )
     {
          /*TODO Expand isAllowed to include role parent*/
          
          $sql = 'SELECT * FROM PrivateRoutePermissions WHERE role = ? AND route = ?';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array($user->role,$route->name));
          $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
          $ans = (count($results) > 0) ? true:false;
          if($ans)
          {               
               return true;
          }
          else
          {
          
               $sql = 'SELECT * FROM Roles WHERE parent = ?';
               $sth = $this->connection()->prepare($sql);
               $sth->execute(array($user->role));
               $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
               foreach($results as $result)
               {
                    $sql = 'SELECT * FROM PrivateRoutePermissions WHERE role = ? AND route = ?';
                    $sth = $this->connection()->prepare($sql);
                    $sth->execute(array($result['role'],$route->name));
                    $fresults = $sth->fetchAll(\PDO::FETCH_ASSOC);
                    if(count($fresults) > 0)
                    {
                         return true;
                    }                    
               }
          }
          return false;
     }
     
     public function addPrivateRoute( Route $route )
     {
          $privateRouteId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO PrivateRoutes set route=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($route->name));
                    $privateRouteId = $this->connection()->lastInsertId();
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
          return $privateRouteId;
     }
     
     public function addPrivateRoutePermission( $role, Route $route )
     {
          $privateRoutePermissionId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO PrivateRoutePermissions set role=?, route=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($role, $route->name));
                    $privateRoutePermissionId = $this->connection()->lastInsertId();
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
          return $privateRoutePermissionId;
     }
     
     public function getPrivateRoutes()
     {
          $sql = 'SELECT * FROM PrivateRoutes';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getPrivateRoutePermissions()
     {
          $sql = 'SELECT * FROM PrivateRoutePermissions';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function deletePrivateRoutePermission($role, Route $route)
     {
          $sql = 'DELETE FROM PrivateRoutePermissions where role=? AND route=?';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array($role, $route->name));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }  
}