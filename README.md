# KISS MVC Cheat Sheet # 

## Directory Structure ##

### Configs ### 
```
#!php

/root
/root/Config
/root/Config/Config.ini
/root/Library
```

### Data ### 
```
#!php
/root/Library/Data
/root/Library/Data/Pdo
/root/Library/Data/Pdo/MySql.php extends PDO	
/root/Library/Data/Pdo/MySql
/root/Library/Data/Pdo/MySql/Table
		->connection()
```

### Filters ### 
```
/root/Library/Filters
/root/Library/Filters/CamelCaseToUnderscore.php
		CamelCaseToUnderscore::filter( $word )
/root/Library/Filters/StripAlpha.php
		StripAlpha::filter( $str )
/root/Library/Filters/ToObject.php
		ToObject::filter( $array )
```

### Traits ### 
```
/root/Library/Traits/
```

### Validation ### 
```
/root/Library/Validation
```
/root/Library/Validation/MemberExists.php
		MemberExists::inValid( $str )
```

## Library Files ##

### Application ### 
```
/root/ Library/Application.php
		Application::getInstance()
		Application::init()
		->getGUID()
		->getConfigs()
		->gotoRouteAndExit(Request $request)
```

### Autoload ### 
```
/root/ Library/Autoload.php
```
```
/root/ Library/Config.php
		->Production
		->Routes
		->Database
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
/root/ Library/Database.php
/root/ Library/Exception.php
/root/ Library/Module.php
/root/ Library/Request.php
	->getCurrentRequest()
	->requestToRoute()
	->getParams
	->getParam
	->setRoute(Route $route, $params = null)
	->getRoute()
	->isValid()
/root/ Library/Route.php
	Route::getInstance()
	->isValid()
	->name
	->module
	->controller
	->action
	->routePattern
/root/ Library/RouteList.php
	->getRoute($name)
	->routes
```

```
/root/Modules
```

```
/root/Modules/Primary
/root/Modules/Primary/Controllers
/root/Modules/Primary/Controllers/Pages.php
		extends Library/Controller or Auth/Controller	
/root/Modules/Primary/Views
```

```
/root/Public
/root/Public/css
/root/Public/fonts
/root/Public/img
/root/Public/js
/root/Public/index.php
```

```
/root/.htaccess
/root/readme.md
```