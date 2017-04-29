<?php
namespace Modules\Primary\Data\Tables;
use Library\Data\Pdo\MySql\Table;
use Modules\Primary\Data\Model\User as UserModel;
class Users extends Table
{     
     protected $_name = 'Test';
     
     public function createUsers()
     {
          $sql = 'create table Users(
            `id` serial auto_increment,
            `gender` ENUM("male", "female") NOT NULL,
            `title` varchar(36) NOT NULL,
            `first` varchar(36) NOT NULL,
            `last` varchar(36) NOT NULL,
            `email` varchar(56) NOT NULL,
            `username` varchar(36) NOT NULL,
            `password` varchar(36) NOT NULL,
            `salt` varchar(8) NOT NULL,
            `registered` varchar(36) NOT NULL,
            `dob` varchar(36) NOT NULL,
            `ssn` varchar(36) NOT NULL
        )';        
        $this->connection()->query($sql, \PDO::FETCH_ASSOC);
     }
     
     public function dropTheTables()
     {
          $this->connection()->query('drop table Pictures', \PDO::FETCH_ASSOC);
          $this->connection()->query('drop table Locations', \PDO::FETCH_ASSOC);
          $this->connection()->query('drop table Numbers', \PDO::FETCH_ASSOC);
          $this->connection()->query('drop table Users', \PDO::FETCH_ASSOC);
     }
     
     public function getUsers()
     {          
          foreach ($this->connection()->query('select * from Users', \PDO::FETCH_ASSOC) as $row)
          {
               $rows[] = $row;
          }
          return $rows;
     }
          
     public function getUser($id)
     {          
          $sql = 'SELECT * FROM Users where Users.id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getUserById($id)
     {          
          $sql = 'SELECT * FROM Users WHERE id = ?';
          $sth = $this->_db->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }     
          
     public function getUsersByGender($gender)
     {          
          $sql = 'SELECT * FROM Users WHERE gender = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array(strtolower($gender)));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getUsersLocations($id)
     {
          $sql = 'SELECT Location.user, Location.id as location, street, city, state, zip, title, first, last, email, username, password, salt, registered, dob, ssn FROM Location inner join Users on Location.user=Users.id where Users.id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getUsersNumbers($id)
     {
          $sql = 'SELECT Numbers.user, Numbers.id as numbers, Numbers.number, title, first, last, email, username, password, salt, registered, dob, ssn FROM Numbers inner join Users on Numbers.user=Users.id where Users.id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function getUsersPictures($id)
     {
          $sql = 'SELECT Pictures.user, Pictures.id as pictures, picture, gender, title, first, last, email, username, password, salt, registered, dob, ssn FROM Pictures inner join Users on Pictures.user=Users.id where Users.id = ?';
          $sth = $this->connection()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
          $sth->execute(array($id));
          return $sth->fetchAll(\PDO::FETCH_ASSOC);
     }
     
     public function addUser(UserModel $user)
     {
          $userId = false;
          try
          {
               $stmt = $this->connection()->prepare("INSERT INTO Users set gender=?,title=?,first=?,last=?,email=?,username=?,password=?,salt=?,registered=?,dob=?,SSN=?");
               try
               {
                    $this->connection()->beginTransaction();
                    $stmt->execute( array($user->gender
                                          ,$user->title
                                          ,$user->first
                                          ,$user->last
                                          ,$user->email
                                          ,$user->username
                                          ,$user->password
                                          ,$user->salt
                                          ,$user->registered
                                          ,$user->dob
                                          ,$user->ssn));
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
}