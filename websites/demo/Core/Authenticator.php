<?php

namespace Core;

use Core\App;
use Core\Database;
use Core\Session;

class Authenticator
{
    public function attempt( $email, $password)
    {
        //resolve the DataBase connection from the container
        //Match inputs with my database
        $user = App::resolve(Database::class)
             ->query('SELECT * FROM users WHERE `email` = :email', [
                     'email'    => $email ,
                ])->find();

        if( $user )
        {
            
            if( password_verify($password, $user['password']) )
            {   
                $this->login(['email' => $email ]);

                return true;
                
            }
            
        }

        return false;
                
    }//End attempt Function

    
    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
            ] ;

        session_regenerate_id(true);
    }//End login Function


    public function logout()
    {
        Session::destroy();
        
    }//End logout Function


}