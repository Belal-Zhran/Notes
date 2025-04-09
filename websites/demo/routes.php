<?php

//The root path on server
$root = '/websites/demo/';


// Main Pages
$router->get( $root             , 'index.php');

$router->get( ($root."about")   , 'about.php');

$router->get( ($root."contact") , 'contact.php');

//>>>>>>>>>>>>>>   Notes rescource  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// Notes Pages
$router->get( ($root."notes")        , 'notes/index.php')->only('auth');

$router->get( ($root."note")         , 'notes/show.php');

$router->get( ($root."note/edit")    , 'notes/edit.php');
$router->patch( ($root."note")       , 'notes/update.php');

$router->delete( ($root."note")      , 'notes/destroy.php');

$router->get( ($root."notes/create")  , 'notes/create.php');
$router->post( ($root."notes/create") , 'notes/store.php');


//>>>>>>>>>>>>>>   Register rescource  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
$router->get( ($root."register")  , 'registration/create.php')->only('guest');
$router->post( ($root."register") , 'registration/store.php')->only('guest');

//>>>>>>>>>>>>>>   Login rescource  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
$router->get( ($root."login")     , 'session/create.php')->only('guest');
$router->post( ($root."session")  , 'session/store.php')->only('guest');

$router->delete( ($root."session"), 'session/destroy.php')->only('auth');









/*

################### First Virsion ########################

$root = '/websites/demo/';

return [

     $root                => 'controllers/index.php' ,

    $root."about"        => 'controllers/about.php' ,
    
    $root."notes"        => 'controllers/notes/index.php' ,
    
    $root."note"         => 'controllers/notes/show.php',

    $root."notes/create" => 'controllers/notes/create.php',
    
    $root."contact"      => 'controllers/contact.php'
];


*/