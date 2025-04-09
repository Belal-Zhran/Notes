<?php
use Core\Response;

function dd($var)
{
    echo'<pre>';
    var_dump($var);
    echo'</pre>';

    die();

}

function UrlIs ($value)
{
    return $_SERVER["REQUEST_URI"]=== $value;

}

function abort($code = 404)
{
    http_response_code($code);

    require base_path( "views/{$code}.php" );
    die();
        
}//End abort Function



function authorize ($condition ,$status = Response::FORBIDDEN)
{
    if( ! $condition)
    {
        abort($status);
    }
}

function base_path($path)
{
    return Base_PATH . $path;
}

function view($path, $attributes = [] )
{
    extract($attributes);
    
    require base_path( 'views/'. $path);
}

function redirect($path)
{

    header("location: {$path}");
    die();

}

function old($key, $default = '')
{
    return Core\Session::get($key) ?? $default;
}