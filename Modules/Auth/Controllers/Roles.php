<?php
namespace Modules\Auth\Controllers;
use Modules\Auth\Controllers\Auth;
class Roles extends Auth
{
     public function roles()
     {
          /*
          $adminId = $this->getTable('Roles','Auth')->addRole( 'Admin' );
          $ceoId = $this->getTable('Roles','Auth')->addRole( 'Ceo',$adminId );
          $reg1Id = $this->getTable('Roles','Auth')->addRole( 'Region-1',$ceoId );
          $reg2Id = $this->getTable('Roles','Auth')->addRole( 'Region-2',$ceoId );
          $reg3Id = $this->getTable('Roles','Auth')->addRole( 'Region-3',$ceoId );
          $reg4Id = $this->getTable('Roles','Auth')->addRole( 'Region-4',$ceoId );
          $reg5Id = $this->getTable('Roles','Auth')->addRole( 'Region-5',$ceoId );
          
          $reg1Dist1Id = $this->getTable('Roles','Auth')->addRole( 'District-1', $reg1Id );
          $reg1Dist2Id = $this->getTable('Roles','Auth')->addRole( 'District-2', $reg1Id );
          $reg1Dist3Id = $this->getTable('Roles','Auth')->addRole( 'District-3', $reg1Id );
          $reg1Dist4Id = $this->getTable('Roles','Auth')->addRole( 'District-4', $reg1Id );
          $reg1Dist5Id = $this->getTable('Roles','Auth')->addRole( 'District-5', $reg1Id );
          
          $reg1Dist1Store1Id = $this->getTable('Roles','Auth')->addRole( 'Store-1',$reg1Dist1Id );
          $reg1Dist1Store2Id = $this->getTable('Roles','Auth')->addRole( 'Store-2',$reg1Dist1Id );
          $reg1Dist1Store3Id = $this->getTable('Roles','Auth')->addRole( 'Store-3',$reg1Dist1Id );
          
          $this->getTable('Roles','Auth')->addRole( 'Manager',$reg1Dist1Store1Id );
          $this->getTable('Roles','Auth')->addRole( 'Assistant-Manager',$reg1Dist1Store1Id );
          $this->getTable('Roles','Auth')->addRole( 'Employee',$reg1Dist1Store1Id );
          
          $this->getTable('Roles','Auth')->addRole( 'Manager',$reg1Dist1Store2Id );
          $this->getTable('Roles','Auth')->addRole( 'Assistant-Manager',$reg1Dist1Store2Id );
          $this->getTable('Roles','Auth')->addRole( 'Employee',$reg1Dist1Store2Id );
          
          $this->getTable('Roles','Auth')->addRole( 'Manager',$reg1Dist1Store3Id );
          $this->getTable('Roles','Auth')->addRole( 'Assistant-Manager',$reg1Dist1Store3Id );
          $this->getTable('Roles','Auth')->addRole( 'Employee',$reg1Dist1Store3Id );
          */
          if(isset($_POST['output']) && $_POST['output']=='json')
          {
               $roleId = isset($_POST['role']) && is_numeric($_POST['role']) ? $_POST['role'] : 0;
               $this->renderAsJSON($this->getTable('Roles', 'Auth')->getRolesByParentId($roleId));
          }
          $this->roles = $this->getTable('Roles', 'Auth')->getParentRoles();
          
          
     }
     
     public function add()
     {
          if(isset($_POST['output']) && $_POST['output'] == 'json')
          {
               $this->setNoRenderView();
          }
          if(isset($_POST['role']))
          {
               $role = $_POST['role'];
          }
          $this->getTable('Roles','Auth')->addRole( 'Guest','Admin' );
     }
     
     public function delete()
     {
          
     }
     
     public function getRoles()
     {
          $this->setNoRenderView();
     }     
}