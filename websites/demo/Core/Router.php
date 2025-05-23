<?php

namespace Core;

use Core\Middleware\Middleware;
use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Router
{
    protected $routes =[];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri'        => $uri ,
            'controller' => $controller,
            'method'     => $method,
            'middleware' => null
        ];

        return $this;

    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);

    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
        
    }

    public function delete($uri, $controller)
    {
        return $this->add("DELETE", $uri, $controller);
        
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);

    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
        
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }




    public function route($uri, $method)
    {
        foreach( $this->routes as $route )
        {
            if( $route['uri'] ==$uri && $route['method']== strtoupper($method) )
            {
                //lets applay the Middleware
                Middleware::resolve($route['middleware']);


                return require base_path('Http/controllers/'.$route['controller']);
            }
        }

        //There is No Matched Route ==>> Abort
        echo($_SERVER["REQUEST_URI"]);
        echo($_SERVER["REQUEST_METHOD"]);
        $this ->abort();



    }

    public function previousUrl()
    {
       
        return $_SERVER['HTTP_REFERER'];
    }
    
    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path( "views/{$code}.php" );
        die();
        
    }//End abort Function




}









/*

####### Second  version ##########

function routeToController($uri, $routes)
{

    //Check on which path to go on
    if (array_key_exists($uri, $routes) )
    {
        require base_path( $routes[$uri] );
    }else
    {
        echo($_SERVER["REQUEST_URI"]);
        abort(404);

    }//End if


}//End routeToController Function





####### first  version ##########

echo "<pre>";
print_r($routes);
echo "</pre>"; 

// if($uri === $root )
// {
//     require'controllers/index.php';    

// }elseif($uri === ($root."about") )
// {
//     require'controllers/about.php';
    

// }elseif($uri === ($root.'contact') )
// {
//     require'controllers/contact.php';
// }else{
//     echo 'Else Result';
// }

*/