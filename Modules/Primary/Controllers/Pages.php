<?php
namespace Modules\Primary\Controllers;
use \Modules\Auth\Controllers\Auth;
class Pages extends Auth
{
    public function home()
    {
        /*
        $this->getTable('PublicRoutes','Auth')->createPublicRoutes();
        $this->getTable('PrivateRoutes','Auth')->createPrivateRoutes();
        $this->getTable('PrivateRoutes','Auth')->createPrivateRoutePermissions();
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['AuthenticateUserByAuthForm'] );
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['LogIn'] );
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['LogOut'] );
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['ApiAuthenticate'] );
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['GetPicturesByUserId'] );
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['Error'] );        
        $this->getTable('PublicRoutes','Auth')->addPublicRoute( $this->_instance->getRouteList()->routes['Primary'] );
        
        $this->getTable('Roles','Auth')->createRoles();
        $this->getTable('Roles','Auth')->addRole( 'Admin' );
        $this->getTable('Roles','Auth')->addRole( 'Guest','Admin' );        

        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Dashboard'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Dashboard'] );
        //$this->getTable('PrivateRoutes','Auth')->deletePrivateRoutePermission( 'Guest', $this->_instance->getRouteList()->routes['Dashboard'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddRole'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddRole'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteRole'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteRole'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetRoles'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetRoles'] );
        
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddPublicRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddPublicRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeletePublicRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeletePublicRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetPublicRoutes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetPublicRoutes'] );        
        
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddPrivateRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddPrivateRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeletePrivateRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeletePrivateRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetPrivateRoutes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetPrivateRoutes'] );
        
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddPrivateRoutePermission'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddPrivateRoutePermission'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeletePrivateRoutePermission'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeletePrivateRoutePermission'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetPrivateRoutePermissions'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetPrivateRoutePermissions'] ); 
        
        
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddAuthUser'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddAuthUser'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteAuthUser'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteAuthUser'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetAuthUsers'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetAuthUsers'] ); 
        
        
        $this->getTable('Users','Auth')->createUsers();
        $user = $this->getModel('User','Auth');
        $user->role = 'Guest';
        $this->getTable('Users','Auth')->addUser($user);
        $user->role = 'Admin';
        this->getTable('Users','Auth')->addUser($user);  
        //$this->getTable('Users','Auth')->disableUserById(1);
        //$this->getTable('Users','Auth')->disableUserById(2);
        $this->getTable('Users','Auth')->enableUserById(1);
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Configs'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Configs'] );       
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddConfig'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddConfig'] );        
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['UpdateConfig'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['UpdateConfig'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteConfig'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteConfig'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Backup'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Backup'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Restore'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Restore'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Routes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Routes'] ); 

        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['UpdateRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['UpdateRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AuthUsers'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AuthUsers'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddAuthUser'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddAuthUser'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteAuthUser'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteAuthUser'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetAuthUsers'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetAuthUsers'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['EnableAuthUsers'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['EnableAuthUsers'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DisableAuthUsers'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DisableAuthUsers'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Roles'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Roles'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddRole'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddRole'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteRole'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteRole'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetRoles'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetRoles'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['PublicRoutes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['PublicRoutes'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddPublicRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddPublicRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeletePublicRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeletePublicRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetPublicRoutes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetPublicRoutes'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['PrivateRoutes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['PrivateRoutes'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddPrivateRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddPrivateRoute'] ); 
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeletePrivateRoute'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeletePrivateRoute'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetPrivateRoutes'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetPrivateRoutes'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Permissions'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Permissions'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddPrivateRoutePermissions'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddPrivateRoutePermissions'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeletePrivateRoutePermission'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeletePrivateRoutePermission'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['GetPrivateRoutePermissions'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['GetPrivateRoutePermissions'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Modules'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Modules'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddModule'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddModule'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteModule'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteModule'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['UploadModule'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['UploadModule'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Resources'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Resources'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['AddResource'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['AddResource'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['DeleteResource'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['DeleteResource'] ); 
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['UploadResource'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['UploadResource'] ); 
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['Lookup'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 'Admin', $this->_instance->getRouteList()->routes['Lookup'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['ViewAuthUserProfile'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 1, $this->_instance->getRouteList()->routes['ViewAuthUserProfile'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['ViewAuthUserPhoneList'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 1, $this->_instance->getRouteList()->routes['ViewAuthUserPhoneList'] );
        
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoute( $this->_instance->getRouteList()->routes['ViewAuthUserAddressList'] );
        $this->getTable('PrivateRoutes','Auth')->addPrivateRoutePermission( 1, $this->_instance->getRouteList()->routes['ViewAuthUserAddressList'] );
        
        
        $this->roles = $this->getTable('Roles','Auth')->getRoles();
        $this->publicRoutes = $this->getTable('PublicRoutes','Auth')->getPublicRoutes();
        $this->privateRoutes = $this->getTable('PrivateRoutes','Auth')->getPrivateRoutes();
        $this->privateRoutePermissions = $this->getTable('PrivateRoutes','Auth')->getPrivateRoutePermissions();
        $this->users = $this->getTable('Users','Auth')->getUsers();
        $this->test = $this->getTable('Users','Primary')->getUsers();        
        
        */
        
    }
    
    public function addDummyInformation()
    {
        $this->setNoRenderView();  
        $refresh = $this->getRequest()->getParam('refresh') ? true:false;
        if($refresh)
        {
            $this->getTable('Users','Primary')->dropTheTables();
            $this->getTable('Users','Primary')->createUsers();
            $this->getTable('Location','Primary')->createLocation();
            $this->getTable('Numbers','Primary')->createNumbers();
            $this->getTable('Pictures','Primary')->createPictures();            
        }        
        set_time_limit(90);
        $rows = [];
        $data = json_decode(file_get_contents('https://api.randomuser.me/0.4/?results=20'));
        foreach($data->results as $result )
        {
            $usersModel = $this->getModel('User', 'Primary');
            $usersModel->gender = ucwords( $result->user->gender );
            $usersModel->title = ucwords( $result->user->name->title);
            $usersModel->first = ucwords( $result->user->name->first);
            $usersModel->last = ucwords( $result->user->name->last);
            $usersModel->email = strtolower($result->user->email);
            $usersModel->username = $result->user->username;
            $usersModel->password = $result->user->password;
            $usersModel->salt = $result->user->salt;
            $usersModel->registered = $result->user->registered;
            $usersModel->dob = $result->user->dob;
            $usersModel->ssn = $result->user->SSN;
            
            $userId = $this->getTable('Users','Primary')->addUser($usersModel);
            
            $locationsModel = $this->getModel('Location', 'Primary');            
            $locationsModel->user = $userId;
            $locationsModel->street = ucwords( $result->user->location->street);
            $locationsModel->city = ucwords( $result->user->location->city);
            $locationsModel->state = ucwords( $result->user->location->state);
            $locationsModel->zip = $result->user->location->zip;
            $this->getTable('Location','Primary')->addLocation($locationsModel);
            
            $numbersModel = $this->getModel('Numbers', 'Primary');
            $numbersModel->user = $userId;
            $numbersModel->number = $result->user->phone;
            $this->getTable('Numbers','Primary')->addNumber($numbersModel);
            
            $numbersModel = $this->getModel('Numbers', 'Primary');
            $numbersModel->number = $result->user->cell;
            $this->getTable('Numbers','Primary')->addNumber($numbersModel);
            
            $picturesModel = $this->getModel('Pictures', 'Primary');
            $picturesModel->user = $userId;
            $picturesModel->picture = $result->user->picture;
            $this->getTable('Pictures','Primary')->addPicture($picturesModel);
        }
        header('Location: /');
    }
    
    public function getUsers()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Users','Primary')->getUsers());
        exit();
    }
    
    public function getUser()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Users','Primary')->getUser($this->getRequest()->getParam('id')));
        exit();
    }
    
    public function getLocationsByUserId()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Users','Primary')->getUsersLocations($this->getRequest()->getParam('id')));
        exit();
    }
        
    public function getNumbersByUserId()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Users','Primary')->getUsersNumbers($this->getRequest()->getParam('id')));
        exit();
    }
    
    public function getPicturesByUserId()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Users','Primary')->getUsersPictures($this->getRequest()->getParam('id')));
        exit();
    }    
        
    public function getLocationById()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Location','Primary')->getLocationById($this->getRequest()->getParam('id')));
        exit();
    }
        
    public function getNumberById()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Numbers','Primary')->getNumberById($this->getRequest()->getParam('id')));
        exit();
    }
    
    public function getPictureById()
    {
        $this->setNoRenderView();
        header('Content-Type: application/json');
        echo json_encode($this->getTable('Pictures','Primary')->getPictureById($this->getRequest()->getParam('id')));
        exit();
    }
}

