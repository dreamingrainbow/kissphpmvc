<?php
namespace Modules\Primary\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Primary\Data\Model\Numbers as NumberModel;
class Numbers extends Table
{     
     protected $_name = 'Test';
     
     public function createNumbers()
     {
          $sql = 'create table Numbers(
            `id` serial auto_increment,
            `user` bigint(20) unsigned NOT NULL,
            `number` varchar(14) NOT NULL,
            FOREIGN KEY (`user`) REFERENCES Users(`id`))';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function getNumbers()
     {          
          foreach ($this->connection()->query('select * from Numbers', \PDO::FETCH_ASSOC) as $row)
          {
               $rows[] = $row;
          }
          return $rows;
     }
     
     public function getNumberById($id)
     {          
          $sql = 'SELECT * FROM Numbers WHERE id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getNumbersByUserId($id)
     {          
          $sql = 'SELECT * FROM Numbers WHERE user = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function addNumber(NumberModel $number)
     {
          $numberId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO Numbers set user=?, number=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($number->user, $number->number));
                    $numberId = $this->connection()->lastInsertId();
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
          return $numberId;
     }
}