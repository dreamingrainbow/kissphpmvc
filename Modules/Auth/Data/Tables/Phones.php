<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\Phones as PhonesModel;
class Phones extends Table
{     
     protected $_name = 'Test';
     
     public function createPhones()
     {
          $sql = 'create table AuthUserPhones(
            `id` serial auto_increment,
            `user_id` bigint(20) unsigned NOT NULL,
            `phone` varchar(20) NOT NULL,
            `phone_type` ENUM ("cell","landline") NOT NULL,
            `active` boolean NOT NULL DEFAULT FALSE,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `AuthUsers` (`id`)
            )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     
     
     public function getPhones($all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserPhones';
          if(!$all)
          {
               $sql .=" where AuthUserPhones.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
          
     }
     
     public function getPhoneById($id)
     {
          $sql = 'SELECT * FROM AuthUserPhones where id=?';          
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchRow(\PDO::FETCH_ASSOC);
     }
     
     public function getPhonesByUserId($id, bool $all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserPhones where user_id=?';          
          if(!$all)
          {
               $sql .=" and AuthUserPhones.active={$a}";
          }          
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);           
     }
     
     public function addPhone(PhonesModel $phone)
     {
          $phoneId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO AuthUserPhones set user_id=?, phone=?, phone_type=?, active=TRUE");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array( $phone->user_id, $phone->phone, $phone->phone_type ));
                    $phoneId = $this->connection()->lastInsertId();
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
          return $phoneId;
     }
     
     public function enablePhone($id)
     {
          $phoneId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserPhones set active=TRUE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $phoneId = $stmt->execute( array( $id ));
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
          return $phoneId;
     }
     
     public function disablePhone($id)
     {
          $phoneId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserPhones set active=FALSE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $phoneId = $stmt->execute( array( $id ));
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
          return $phoneId;
     }
     
     public function deletePhone($id)
     {
          $phoneId = false;
          try
          {
               $stmt = $this->connection()->prepare("DELETE FROM AuthUserCredentials WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $phoneId = $stmt->execute( array( $id ));
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
          return $phoneId;
     }
}