# KISS MVC Cheat Sheet  
This page is a brief overview of the structure and function available from the base KISS MVC. There are many way's to use this framework, for example if your just displaying a page you wont need a controller action, however if you have controller action's that need to override the view utilizing the controller to control your view. The main idea behind this framework was I loved how the first versions of ZF you where able to get started quickly and not worry as much about the page url but what the page should be doing. Creating code that last is as important as creating code that can easily be modified to grow with the future. Kiss a simple MVC style framework will allow your to get the basics out of the way and develop the application you want. Below list the basic edition of KISS MVC Framework.

## Directory Structure 

### Configs 
```
#!php

/root
/root/Config
/root/Config/Config.ini
/root/Library
```

### Data 
```
#!php
/root/Library/Data
/root/Library/Data/Pdo
/root/Library/Data/Pdo/MySql.php extends PDO	
/root/Library/Data/Pdo/MySql
/root/Library/Data/Pdo/MySql/Table
		->connection()
```

### Filters 
```
/root/Library/Filters
/root/Library/Filters/CamelCaseToUnderscore.php
		CamelCaseToUnderscore::filter( $word )
/root/Library/Filters/StripAlpha.php
		StripAlpha::filter( $str )
/root/Library/Filters/ToObject.php
		ToObject::filter( $array )
```

### Traits
```
/root/Library/Traits/
```

### Validation
```
/root/Library/Validation
/root/Library/Validation/MemberExists.php
		MemberExists::inValid( $str )
```

## Library Files 

### Application

```
/root/ Library/Application.php
		Application::getInstance()
		Application::init()
		->getGUID()
		->getConfigs()
		->gotoRouteAndExit(Request $request)
```

### Autoload
```
/root/ Library/Autoload.php
```

### Config
```
/root/ Library/Config.php
		->Production
		->Routes
		->Database
```

### Autoload
```
/root/ Library/Controller.php
	->dispatch()
	->setNoRenderView()
	->setView()
	->getRequest()
	->getPartial( $partial, $module, $params = null)
	->fileNotFound($msg = null)
	->permissionDenied($msg = null)
	->exec()
	->Db()
	->getTable($table, $module = 'Primary')
	->getModel($model, $module = 'Primary')
	->renderAsJSON($arr)
	->getInstance()
	->gotoRouteAndExit(Request $request)
```

### Database
```
/root/ Library/Database.php
```

### Autoload
```
/root/ Library/Exception.php
```

### Autoload
```
/root/ Library/Module.php
```
### Request
```
/root/ Library/Request.php
	->getCurrentRequest()
	->requestToRoute()
	->getParams
	->getParam
	->setRoute(Route $route, $params = null)
	->getRoute()
	->isValid()
```

### Route
```
/root/ Library/Route.php
	Route::getInstance()
	->isValid()
	->name
	->module
	->controller
	->action
	->routePattern
```

### RouteList
```
/root/ Library/RouteList.php
	->getRoute($name)
	->routes
```

### Modules
```
/root/Modules
```

### Primary Module
```
/root/Modules/Primary
/root/Modules/Primary/Controllers
/root/Modules/Primary/Controllers/Pages.php
		extends Library/Controller or Auth/Controller	
/root/Modules/Primary/Views
```

### Public Folders
```
/root/Public
/root/Public/css
/root/Public/fonts
/root/Public/img
/root/Public/js
/root/Public/index.php
```

### htaccess and Readme
```
/root/.htaccess
/root/readme.md
```