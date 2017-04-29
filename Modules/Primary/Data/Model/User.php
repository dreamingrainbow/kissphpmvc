<?php
namespace Modules\Primary\Data\Model;
class User
{
     public $id;
     public $gender;
     public $title;
     public $first;
     public $last;
     public $email;
     public $username;
     public $password;
     public $salt;
     public $registered;
     public $dob;
     public $ssn;     
     
     public function getId()
     { 
          return $this->id; 
     }
     
     public function setId($id)
     { 
          $this->id = $id; 
     }
 
     public function getGender()
     { 
          return $this->gender; 
     }
     
     public function setGender($gender)
     { 
          $this->gender = $gender; 
     }
 
     public function getTitle()
     { 
          return $this->title; 
     }
     
     public function setTitle($title)
     { 
          $this->title = $title; 
     }
 
     public function getFirst()
     { 
          return $this->first; 
     }
     
     public function setFirst($first)
     { 
          $this->first = $first; 
     }
 
     public function getLast()
     { 
          return $this->last; 
     }
     
     public function setLast($last)
     { 
          $this->last = $last; 
     }
 
     public function getEmail()
     { 
          return $this->email; 
     }
     
     public function setEmail($email)
     { 
          $this->email = $email; 
     }
 
     public function getUsername()
     { 
          return $this->username; 
     }
     
     public function setUsername($username)
     { 
          $this->username = $username; 
     }    
 
     public function getPassword()
     { 
          return $this->password; 
     }
     
     public function setPassword($password)
     { 
          $this->password = $password;
     }
 
     public function getSalt()
     { 
          return $this->salt; 
     }
     
     public function setSalt($salt)
     { 
          $this->salt = $salt; 
     }
 
     public function getRegistered()
     { 
          return $this->registered; 
     }
     
     public function setRegistered($registered)
     { 
          $this->registered = $registered; 
     }    
 
     public function getDob()
     { 
          return $this->dob;
     }
     
     public function setDob($dob)
     { 
          $this->dob = $dob; 
     }     
 
     public function getSsn()
     { 
          return $this->ssn; 
     }
     
     public function setSsn($ssn)
     { 
          $this->ssn = $ssn; 
     }
}