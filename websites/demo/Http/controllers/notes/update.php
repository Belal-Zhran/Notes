<?php

use Core\App;
use Core\Database;
use Core\Validator;


//resolve the DataBase connection from the container
$db = App::resolve(Database::class);

$currentUserId= 1 ;

    
//Get the exact Note from The Database
$note = $db -> query("SELECT * FROM notes WHERE `id`=:id",[
                        'id'=> $_POST['id']
                    ]) -> findOrFail();


//Check if the user have permission 
authorize( $note['user_id'] == $currentUserId);

//Validate the form
$errors = [];




// Vlidation
if( ! Validator::string($_POST['body'], 1, 1000) )
{
    $errors['body'] = "Note body should Not be Empty or more than 1000 ! ";
}

//Redirect to the same Page with Error list
if( !empty($errors))
{
    
    return view( "notes/edit.view.php",[

                'heading' => 'Edit Note',
                'errors'  => $errors,
                'note'    => $note

            ]);
}

// All is Clear

$db ->query("UPDATE `notes` set body = :body WHERE id = :id ",[
        'id' => $_POST['id'],
        'body' => $_POST['body']
    ]);

    
//Redirecte to Notes Page
header("location: /websites/demo/notes");
die();

