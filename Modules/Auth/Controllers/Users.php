<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Users extends Auth
{
     public function users()
     {

          $this->roles = $this->getTable('Roles', 'Auth')->getParentRoles();
          
          
          $filterType = isset($_POST['filterType']) ? $_POST['filterType'] : 'None';
          switch($filterType)
          {
               case 'all':
                    $this->users = $this->getTable('Users', 'Auth')->getUsers(true);
                    break;
               case 'disabled':
                    $this->users = $this->getTable('Users', 'Auth')->getUsers(false, false);
                    break;
               case 'enabled':
               default:
                    $this->users = $this->getTable('Users', 'Auth')->getUsers();
                    break;
          }
          if(isset($_POST['output']) && $_POST['output'] == 'json')
          {
               return $this->renderAsJson($this->users);
          }               
        
     }
     
     public function add()
     {    $pass ='fail';
     
          //After valadation....
     
          $user = $this->getModel('User','Auth');
          $user->role = $_POST['user']["role_id"];          
          $user->first_name = $_POST['user']["first_name"];
          $user->last_name = $_POST['user']["last_name"];          
          $result = $this->getTable('Users','Auth')->addUser( $user  );
          $user_id = $result;
          
          //Credentials
          $credentials = $this->getModel('Credentials','Auth');          
          $credentials->user_id = $user_id;
          $credentials->username = $_POST['user']["username"];
          $credentials->active = true;
          $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
          $string = '';
          $max = strlen($characters) - 1;
          for ($i = 0; $i < 8; $i++)
          {
               $string .= $characters[mt_rand(0, $max)];
          }
          $hash =  password_hash($string, PASSWORD_BCRYPT,['cost' => 12] )."\n";
          $credentials->password = $hash;          
          $newCredentials = $this->getTable('Credentials','Auth')->addCredentials( $credentials  );
          //Email Addresses
          $emails = $this->getModel('Emails','Auth');
          $emails->user_id = $user_id;
          $emails->email = $_POST['user']["email"];
          $emails->active = true;
          $newEmails = $this->getTable('Emails','Auth')->addEmails( $emails  );
          //Phone Numbers
          $phones = $this->getModel('Phones','Auth');
          $phones->user_id = $user_id;
          $phones->phone = $_POST['user']["phone"]; 
          $phones->phone_type = $_POST['user']["phone_type"];
          $phones->active = true;
          $newPhones = $this->getTable('Phones','Auth')->addPhones( $phones  );
          //Addresses
          $addresses = $this->getModel('Addresses','Auth');
          $addresses->user_id = $user_id;
          $addresses->address = $_POST['user']["address"];
          $addresses->address_2 = $_POST['user']["address_2"];
          $addresses->city = $_POST['user']["city"];
          $addresses->state = $_POST['user']["state"];
          $addresses->postal_code = $_POST['user']["postal_code"];
          $addresses->active = true;
          $newAddresses = $this->getTable('Addresses','Auth')->addAddresses( $addresses  );
          if($result !== false)
          {
               $pass ='success';
          }          
          if(isset($_POST['output']) && $_POST['output'] == 'json')
          {
               return $this->renderAsJson(['action'=>$pass, $result, $newCredentials, $newEmails, $newPhones, $newAddresses ]);
          }
     }
     
     public function delete()
     {
          if(!is_numeric($_POST['userId']))
          {
               return $this->getInstance()->permissionDenied('User Id must be a number.');
          }
          $this->getTable('Users', 'Auth')->deleteUserById($_POST['userId']);
          return $this->renderAsJson(['action'=>'success']);
     }
     
     public function enable()
     {
          if(!is_numeric($_POST['userId']))
          {
               return $this->getInstance()->permissionDenied('User Id must be a number.');
          }
          $this->getTable('Users', 'Auth')->enableUserById($_POST['userId']);
          return $this->renderAsJson(['action'=>'success']);
     }
     
     public function disable()
     {
          if(!is_numeric($_POST['userId']))
          {
               return $this->getInstance()->permissionDenied('User Id must be a number.');
          }
          $this->getTable('Users', 'Auth')->disableUserById($_POST['userId']);
          return $this->renderAsJson(['action'=>'success']);
     }
     
     public function viewAuthUserProfile()
     {
          if(!is_numeric($_POST['userId']))
          {
               return $this->getInstance()->permissionDenied('User Id must be a number.');
          }
          return $this->renderAsJson($this->getTable('Users', 'Auth')->getUserProfile($_POST['userId']));
     }
     
     public function viewAuthUserPhoneList()
     {
          if(!is_numeric($_POST['userId']))
          {
               return $this->getInstance()->permissionDenied('User Id must be a number.');
          }
          return $this->renderAsJson($this->getTable('Phones', 'Auth')->getPhonesByUserId($_POST['userId']));
     }
     
     public function viewAuthUserAddressList()
     {
          if(!is_numeric($_POST['userId']))
          {
               return $this->getInstance()->permissionDenied('User Id must be a number.');
          }
          return $this->renderAsJson($this->getTable('Addresses', 'Auth')->getAddressesByUserId($_POST['userId']));
     }
     
     
}