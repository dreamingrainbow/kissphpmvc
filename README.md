# KISS MVC Cheat Sheet  
This page is a brief overview of the structure and functions available from the base KISS MVC Framework. There are many way's to use this framework. For example if you're just displaying a page you will not need a controller action. However, if you have action's that need to override the view utilizing the controller to control your view. KISS... The main idea behind this design of the KISS MVC framework was that I loved how in the first versions of ZF (ZF1.12) you where able to get started quickly and not much to crank out some user authority and a working application. Creating code that last is as important as creating code that can easily be modified to grow with the future. I loved zend but it couldn't keep updated because it was so large. Kiss a simple MVC style framework will allow your to get the basics out of the way and develop the application you want. Below list the basic edition of KISS MVC Framework. There is not a lot to it, so you can build the tools you need, change them as you need, while the base framework is simple enough to keep up to date for years to come. Open source means the community can push to have improvements made, supply alternative versions, or improve the basic functions. The whole idea behind the framework is to keep it simple! Even the most complex algorithms break down to the basics.

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