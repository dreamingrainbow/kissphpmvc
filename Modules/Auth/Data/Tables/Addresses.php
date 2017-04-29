<?php
namespace Modules\Auth\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Auth\Data\Model\Addresses as AddressesModel;
class Addresses extends Table
{     
     protected $_name = 'Test';
     
     public function createAddresses()
     {
          $sql = 'create table AuthUserAddresses(
            `id` serial auto_increment,
            `user_id` bigint(20) unsigned NOT NULL,
            `address` varchar(56) NOT NULL,            
            `address_2` varchar(56),            
            `city` varchar(56) NOT NULL,            
            `state` varchar(56) NOT NULL,
            `postal_code` varchar(56) NOT NULL,
            `active` boolean NOT NULL DEFAULT FALSE,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `AuthUsers` (`id`)
            )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function getAddresses($all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserAddresses';
          if(!$all)
          {
               $sql .=" where AuthUserAddresses.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array());
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getAddressById($id)
     {
                    
          $sql = 'SELECT * FROM AuthUserAddresses where id=?';          
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchRow(\PDO::FETCH_ASSOC);
     }
     
     public function getAddressesByUserId($id, bool $all = false, bool $active = true)
     {
          $a = $active ? '1' : '0';
          $sql = 'SELECT * FROM AuthUserAddresses where user_id=?';
          if(!$all)
          {
               $sql .=" AND AuthUserAddresses.active={$a}";
          }
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function addAddress(AddressesModel $address)
     {
          $addressId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO AuthUserAddresses set user_id=?, address=?, address_2=?, city=?, state=?, postal_code=?, active=TRUE");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array( $address->user_id, $address->address, $address->address_2, $address->city, $address->state, $address->postal_code ));
                    $addressId = $this->connection()->lastInsertId();
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
          return $addressId;
     }
     
     public function enableAddress($id)
     {
          $addressId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserAddresses set active=TRUE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $addressId = $stmt->execute( array( $id ));
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
          return $addressId;
     }
     
     public function disableAddress($id)
     {
          $addressId = false;
          try
          {
               $stmt = $this->connection()->prepare("UPDATE AuthUserAddresses set active=FALSE WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $addressId = $stmt->execute( array( $id ));
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
          return $addressId;
     }
     
     public function deleteAddress($id)
     {
          $addressId = false;
          try
          {
               $stmt = $this->connection()->prepare("DELETE FROM AuthUserAddresses WHERE id=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $addressId = $stmt->execute( array( $id ));
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
          return $addressId;
     }
}