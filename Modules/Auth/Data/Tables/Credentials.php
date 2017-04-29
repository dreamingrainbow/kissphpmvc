<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\Credentials as CredentialsModel;
class Credentials extends Table
{     
     protected $_name = 'Test';
     
     public function createCredentials()
     {
          $sql = 'create table AuthUserCredentials(
            `id` serial auto_increment,
            `user_id` bigint(20) unsigned NOT NULL,
            `username` varchar(56) NOT NULL,
            `password` varchar(60) NOT NULL,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `AuthUsers` (`id`)
            )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }     
     
     public function getCredentials($all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserCredentials';
          if(!$all)
          {
               $sql .=" where AuthUserCredentials.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getCredentialsById($id)
     {
          $sql = 'SELECT * FROM AuthUserCredentials where id=?';          
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchRow(\PDO::FETCH_ASSOC);
     }
     
     public function getCredentialsByUserId($id, bool $all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserCredentials where user_id=?';
          if(!$all)
          {
               $sql .=" where AuthUserCredentials.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);          
     }
     
     public function addCredentials(CredentialsModel $credentials)
     {
          $credentialsId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO AuthUserCredentials set user_id=?, username=?, password=?, active=TRUE");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array( $credentials->user_id, $credentials->username, $credentials->password ));
                    $credentialsId = $this->connection()->lastInsertId();
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
          return $credentialsId;
     }
     
     public function enableCredentials($id)
     {
          $credentialsId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserCredentials set active=TRUE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $credentialsId = $stmt->execute( array( $id ));
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
          return $credentialsId;
     }
     
     public function disableCredentials($id)
     {
          $credentialsId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserCredentials set active=FALSE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $credentialsId = $stmt->execute( array( $id ));
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
          return $credentialsId;
     }
     
     public function deleteCredentials($id)
     {
          $credentialsId = false;     
          try
          {
               $stmt = $this->connection()->prepare("DELETE FROM AuthUserCredentials WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $credentialsId = $stmt->execute( array( $id ));
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
          return $credentialsId;
     }
}