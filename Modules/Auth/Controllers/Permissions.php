<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Permissions extends Auth
{
     public function permissions()
     {
          $this->roles = $this->getTable('Roles', 'Auth')->getRoles();
          $this->selectedRole = 'Admin';
     }  
}