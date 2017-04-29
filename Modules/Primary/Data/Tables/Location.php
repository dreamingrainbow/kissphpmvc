<?php
namespace Modules\Primary\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Primary\Data\Model\Location as LocationModel;
class Location extends Table
{     
     protected $_name = 'Test';
     
     public function createLocation()
     {
          $sql = 'create table Location(`id` serial auto_increment,
            `user` bigint(20) unsigned NOT NULL,
            `street` varchar(56) NOT NULL,
            `city` varchar(56) NOT NULL,
            `state` varchar(56) NOT NULL,
            `zip` varchar(5) NOT NULL,
            FOREIGN KEY (`user`) REFERENCES Users(`id`))';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function getLocations()
     {          
          foreach ($this->connection()->query('select * from Location', \PDO::FETCH_ASSOC) as $row)
          {
               $rows[] = $row;
          }
          return $rows;
     }
     
     public function getLocationById($id)
     {          
          $sql = 'SELECT * FROM Location WHERE id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getLocationsByUserId($id)
     {          
          $sql = 'SELECT * FROM Location WHERE user = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function addLocation(LocationModel $location)
     {
          $locationId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO Location set user=?, street=?, city=?, state=?, zip=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($location->user
                                          ,$location->street
                                          ,$location->city
                                          ,$location->state
                                          ,$location->zip));
                    $locationId = $this->connection()->lastInsertId();
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
          return $locationId;
     }
}