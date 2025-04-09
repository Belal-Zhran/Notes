<?php

namespace Core;

class Container
{
    protected $bindings =[];

    //>>>>>>>>>>>>>> Add to the Container <<<<<<<<<<<< 
    public function bind($key , $resolver)
    {
        $this->bindings[$key] = $resolver;
    }
    
    
    //>>>>>>>>>>>>>> Remove from the Container <<<<<<<<<<<< 
    public function resolve($key)
    {
        //The Key is Not in our Container
        if( !array_key_exists($key , $this->bindings) )
        {
            throw new \Exception("No matching binding found for {$key}");
        }
    
        //The Key Existed in our Container
        $resolver = $this->bindings[$key];
        return call_user_func($resolver);

        
    }
}