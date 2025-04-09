<?php

use Http\Forms\LoginForm;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

// Vlidation
$form = LoginForm::validate([
    'email'    => $email,
    'password' => $password
]);

//validated Successfully
//Authentication
$auth = new Authenticator();

$signedIn = $auth ->attempt( $email, $password );

if( !$signedIn  )
{
    //Account not Authenticated
    $form->adderror( 
            'email','No Matching Account or Password'
        )->throw();

}

redirect('/websites/demo/');