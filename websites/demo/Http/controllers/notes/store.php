<?php

use Core\App;
use Core\Database;
use Core\Validator;


//resolve the DataBase connection from the container
$db = App::resolve(Database::class);

$errors = [];

// Vlidation
if( ! Validator::string($_POST['body'], 1, 1000) )
{
    $errors['body'] = "Note body should Not be Empty or more than 1000 ! ";
}

//Redirect to the same Page with Error list
if( !empty($errors))
{
    
    return view( "notes/create.view.php",[

                'heading' => 'Create Note',
                'errors'   => $errors

            ]);
}

// All is Clear
if(empty($errors))
{
    $db ->query("INSERT INTO `notes` (`body`, `user_id`) VALUES (:body , :user_id)",[
            'body' => $_POST['body'],
            'user_id' => 1
    
        ]);

        
    //Redirecte to Notes Page
    header("location: /websites/demo/notes");
    die();
}





