<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\Emails as EmailsModel;
class Emails extends Table
{     
     protected $_name = 'Test';
     
     public function createEmails()
     {     
          $sql = 'create table AuthUserEmails(
            `id` serial auto_increment,
            `user_id` bigint(20) unsigned NOT NULL,
            `email` varchar(56) NOT NULL,
            `active` boolean NOT NULL DEFAULT FALSE,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `AuthUsers` (`id`)
            )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }     
     
     public function getEmails($all = false, bool $active = true)
     {          
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserEmails';
          if(!$all)
          {
               $sql .=" where AuthUserEmails.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getEmailById($id)
     {
          $sql = 'SELECT * FROM AuthUserEmails where id=?';          
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchRow(\PDO::FETCH_ASSOC);
     }
     
     public function getEmailsByUserId($id, bool $all = false, bool $active = true)
     {          
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserEmails where user_id=?';
          if(!$all)
          {
               $sql .=" where AuthUserEmails.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC); 
     }
     
     public function addEmail(EmailsModel $emails)
     {
          $emailsId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO AuthUserEmails set user_id=?, email=?, active=TRUE");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array( $emails->user_id, $emails->email ));
                    $emailsId = $this->connection()->lastInsertId();
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
          return $emailsId;
     }
     
     public function enableEmail($id)
     {
          $emailsId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserEmails set active=TRUE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $emailsId = $stmt->execute( array( $id ));
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
          return $emailsId;
     }
     
     public function disableEmail($id)
     {
          $emailsId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserEmails set active=FALSE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $emailsId = $stmt->execute( array( $id ));
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
          return $emailsId;
     }
     
     public function deleteEmail($id)
     {
          $emailsId = false;
          try
          {
               $stmt = $this->connection()->prepare("DELETE FROM AuthUserEmails WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $emailsId = $stmt->execute( array( $id ));
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
          return $emailsId;
     }
}