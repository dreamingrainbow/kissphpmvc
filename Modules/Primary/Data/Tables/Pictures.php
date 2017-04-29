<?php
namespace Modules\Primary\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Primary\Data\Model\Pictures as PictureModel;
class Pictures extends Table
{     
     protected $_name = 'Test';
     
     public function createPictures()
     {
          $sql = 'create table Pictures(
            `id` serial auto_increment,
            `user` bigint(20) unsigned NOT NULL,
            `picture` tinyblob,
            FOREIGN KEY (`user`) REFERENCES Users(`id`) 
        )';   
          $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function getPictures()
     {          
          foreach ($this->connection()->query('select * from Pictures', \PDO::FETCH_ASSOC) as $row)
          {
               $rows[] = $row;
          }
          return $rows;
     }
     
     public function getPictureById($id)
     {          
          $sql = 'SELECT * FROM Pictures WHERE id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getPicturesByUserId($id)
     {          
          $sql = 'SELECT * FROM Pictures WHERE user = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function addPicture(PictureModel $picture)
     {
          $pictureId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO Pictures set user=?, picture=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($picture->user, $picture->picture));
                    $pictureId = $this->connection()->lastInsertId();
                    $this->connection()->commit();
               }
               catch(\PDOExecption $e)
               {
                    $this->connection()->rollback();
                    print "Error!: " . $e->getMessage() . "</br>";
               }
          }
          catch( PDOExecption $e )
          {
               print "Error!: " . $e->getMessage() . "</br>";
          }
          return $pictureId;
     }
}