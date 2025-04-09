<?php
use Core\Session;

view('session/create.view.php',[
    'heading' => 'login Page',
    'errors'  => Session::get('errors')
]);