<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\User as UserModel;
class Users extends Table
{     
     protected $_name = 'Test';
     
     public function createUsers()
     {
          $sql = 'drop table AuthUserAddresses;';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
          $sql = 'drop table AuthUserPhones;';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
          $sql = 'drop table AuthUserEmails;';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
          $sql = 'drop table AuthUserCredentials;';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);          
          
          $sql = 'create table AuthUsers(
            `id` serial auto_increment,
            `first_name` varchar(56),
            `last_name` varchar(56),
            `role` bigint(20) unsigned NOT NULL,
            `active` boolean NOT NULL DEFAULT FALSE,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`role`) REFERENCES `Roles` (`id`)
            )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
          
          //debug($this->connection()->errorInfo());
     }

          
     public function addUser( UserModel $user  )
     {
          $userId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO AuthUsers set first_name=?, last_name=?, role=?, active=TRUE");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array( $user->first_name, $user->last_name, $user->role ));
                    $userId = $this->connection()->lastInsertId();
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
          return $userId;
     }

     public function getUsers($all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT AuthUsers.id, AuthUsers.first_name, AuthUsers.last_name, AuthUserCredentials.username, AuthUsers.role, AuthUsers.active FROM AuthUsers';
          $sql .= ' INNER JOIN AuthUserCredentials on (AuthUserCredentials.user_id = AuthUsers.id)';
          if(!$all)
          {
               $sql .=" where AuthUsers.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function enableUserById( $id  )
     {
          $userId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUsers set active=TRUE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $userId = $stmt->execute( array( $id ));
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
          return $userId;
     }
     
     public function disableUserById( $id  )
     {
          $userId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUsers set active=FALSE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $userId = $stmt->execute( array( $id ));
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
          return $userId;
     }
          
     public function deleteUserById( $id  )
     {
          $userId = false;
          try
          {
               $stmt = $this->connection()->prepare("DELETE FROM AuthUsers WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $userId = $stmt->execute( array( $id ));
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
          return $userId;
     }
     
     public function getUserProfile($id)
     {
          $sql = 'SELECT AuthUsers.id, AuthUsers.first_name, AuthUsers.last_name, AuthUserCredentials.username, Roles.id as role_id, Roles.role, (select role from Roles as r2 where Roles.parent = r2.id) as parent, AuthUsers.active, AuthUserEmails.email FROM AuthUsers';
          $sql .= ' INNER JOIN AuthUserCredentials on (AuthUserCredentials.user_id = AuthUsers.id)';
          $sql .= ' INNER JOIN AuthUserEmails on (AuthUserEmails.user_id = AuthUsers.id)';
          $sql .= ' INNER JOIN Roles on (Roles.id = AuthUsers.role)';
          $sql .= ' WHERE AuthUsers.id=?';
          $sql .= ' AND AuthUsers.active=TRUE';
          $sql .= ' AND AuthUserEmails.active=TRUE';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
}