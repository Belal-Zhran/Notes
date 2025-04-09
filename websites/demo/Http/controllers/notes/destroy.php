<?php

use Core\App;
use Core\Container;
use Core\Database;

//resolve the DataBase connection from the container
$db = App::resolve(Database::class);



$currentUserId= 1 ;

//>>>>>> Delete The Note <<<<<<<<<<<<<<<<


$note = $db -> query("SELECT * FROM notes WHERE `id`=:id",[
    'id'=> $_POST['id']
]) -> findOrFail();


//Check if the user have permission 
authorize( $note['user_id'] == $currentUserId);

//>>>>>>>>> Note Deleted <<<<<<<<<<<<<<<<
$db -> query("DELETE FROM notes WHERE `id`=:id",[
    'id' => $_GET['id']

]);

//Redirecte to Notes Page
header("location: /websites/demo/notes");
exit();




