<?php

namespace Core\Middleware;


class auth
{
    public function handle()
    {
        if( !$_SESSION['user'] ?? false)
        {
            header('location: /websites/demo/');
            die();
        }
    }
}