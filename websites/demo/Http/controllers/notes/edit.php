<?php
use Core\App;
use Core\Database;


//resolve the DataBase connection from the container
$db = App::resolve(Database::class);

$currentUserId= 1 ;

    
//Get the exact Note from The Database
$note = $db -> query("SELECT * FROM notes WHERE `id`=:id",[
                        'id'=> $_GET['id']
                    ]) -> findOrFail();


//Check if the user have permission 
authorize( $note['user_id'] == $currentUserId);


view( "notes/edit.view.php",[

    'heading' => 'Edit Note',
    'errors'  => [],
    'note'    => $note

 ]);