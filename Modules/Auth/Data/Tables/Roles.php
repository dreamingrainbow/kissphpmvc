<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\Role as RoleModel;
class Roles extends Table
{     
     protected $_name = 'Test';
     
     public function createRoles()
     {
          $sql = 'create table Roles(
            `id` serial auto_increment,
            `role` varchar(254),
            `parent` bigint(20) unsigned,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`parent`) REFERENCES `Roles` (`id`)
            )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function addRole( $role, $parent = ''  )
     {
          $roleId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO Roles set role=?, parent=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($role, $parent));
                    $roleId = $this->connection()->lastInsertId();
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
          return $roleId;
     }

     public function getRoles()
     {
          $sql = 'SELECT * FROM Roles';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
          
     public function getRolesByParentId($id)
     {
          $sql = 'SELECT * FROM Roles where parent = ?';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     public function getParentRoles()
     {
          $sql = 'SELECT * FROM Roles where parent = 0';
          $sth = $this->connection()->prepare($sql);
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
}