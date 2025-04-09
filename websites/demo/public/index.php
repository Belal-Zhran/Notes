<?php
session_start();

use Core\Router;
use Core\Session;
use Core\ValidationException;


const Base_PATH = __DIR__ . '/../';

require Base_PATH.'Core/functions.php';

spl_autoload_register(function($class){
    
    $class = str_replace('\\', '/' , $class);

    if( str_contains($class,'Middleware' ) )
    {
        
        require_once ( __DIR__ ."\..\Core\Middleware\Middleware.php" );
        require_once ( __DIR__ ."\..\Core\Middleware\Auth.php" );
        require_once ( __DIR__ ."\..\Core\Middleware\Guest.php" );
        
    }else{

        
        require base_path( "{$class}.php" );
    }

    
});

//Container code
require base_path('bootstrap.php');




//require base_path('Core/Router.php');

$router = new Router();

//The Routes of the pages on Website
$routes = require base_path('routes.php');

// Taking the request and clear it && just take the path
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



try
{

    $router ->route($uri, $method);

}//End try
catch(ValidationException $exception)
{

    //save errors in flash session
    Session::flash('errors', $exception->errors );

    Session::flash('oldEmail', $exception->old['email'] );

    return redirect($router->previousUrl() );
}//End catch


Session::unflash();