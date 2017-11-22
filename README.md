###KISS PHP MVC 

I simple to use and configure open source php framework. This is a light weight PHP application framework.

After downloading, you may need to setup your `.htaccess` file for the mod_rewrite conditions.

If you are using the internal php server to test this framework use '-t ./Public'

##Your First App
Navigate kissphpmvc > Modules 

 Here you will see two modules, one our Hello World Module, and the Primary Module. We will use the Primary for this example.

Open the Primary Directory and your will see a Controllers sub-folder, we will get to that in a bit. First lets check out the other sub-folder Views > Scripts > Pages and open home.phtml. You should get familiar with the structure as you should keep a structure close to it to manage the pages of the project!

The home.phtml is considered a view page. You should keep logic out of here that doesn't control what is viewed.

Go Head edit your home.phtml now. Don't worry.. You can include as much HTML and JavaScript you like.

Awesome you have made your first kiss application! If you just wanted a simple site Your good, you wont need to do anything but edit the one file. However, when you are ready to add pages you will want to visit the kissphpmvc > Config folder.

##Config.ini The configuration for kissphpmvc.

With as little as 15 line's to get you started, build on is just as simple. Store your configuration's and static setting's for your application here. This is directly accessible from the application at anytime. 

Access the configurations any where with `Application::getInstance()->getConfigs();`

##Routing Build Routes to pages quickly

Simple routing rules make's it easy to get to the pages, even in the most complex applications. Since kissphpmvc is build to not interfere with POST and GET variable's you have access to those and the routing parameters.
Let's take a look at a route
```
Primary.Module = 'Primary';
Primary.Controller = 'Pages';
Primary.Action = 'home';
Primary.Route.Pattern = '/';
```
#The parts of our route :
 Route Name : This is the first section of each line of a route. It must be unique to the entire route list. 
 Module Name : This is the name of the Module to access
 Controller Name : The name of the controller where we can find controller logic for our action.
 Action Name : The name of the action/method function with in the controller.
 Route Pattern : The pattern of the url string that will be used by the browser to access this route.

Some rule's Route Names must be unique to a route. Although an action name is required for a route you do not have to create the method in the controller. 

#Building Route Patterns
Route patterns can be as complex as you would like but must follow these rules. 

 1 Route Patterns must be unique.
 2 Route Patterns must follow url standards.

Adding Route Pattern parameters can be done by adding `:` in front of the name of the parameter. i.e. `:id`
Route Patterns Breakdown
```
/Test:id/:some/Another:one
```
In the above pattern "Test" and "Another" are Labels and "id" is a parameter as well as "some" and "one"

These parameters can be accessed anywhere in the application using `Application::getInstance()->getRequest()->getParam({PARAM_NAME})` or directly in the controller using `$this->getRequest()->getParam()`

Once you have the route's built you can create a multi page site or a complete API.

#Controller 

Adding controllers is as simple as the rest of kissphpmvc, add a new file, correctly namespaced to the module and start adding methods that create your logic.

#Adding to kissphpmvc
 Easy as dropping in libraries into the controllers folder for the module or put them in the library if you use them an many of your modules.

From here it's up to you! Build your dreams!

I hope you have as much fun with KISSPHPMVC as I do. If you see something wrong, find a bug, think you can improve on the base shoot me an email at support@dreamingrainbow.com
