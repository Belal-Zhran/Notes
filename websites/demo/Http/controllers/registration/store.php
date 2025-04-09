<?php
use Core\App;
use Core\Database;
use Core\Validator;


$email = $_POST['email'];
$password = $_POST['password'];


// Vlidation
$errors = [];
if( !Validator::email($email))
{
    $errors['email'] = 'Please provide a valid email adress !';
}

if( !Validator::string($password, 7, 200))
{
    $errors['password'] = 'Please provide a password  of at least 7 characters!';
}

if( !empty($errors) )
{
    return view('registration/create.view.php',[
        'heading' => 'Registration form',
        'errors' => $errors
    ]);
}


//resolve the DataBase connection from the container
$db = App::resolve(Database::class);

$user =   $db->query('SELECT * FROM users WHERE email = :email',[
                'email' => $email
            ])->find();

//Email already Existed Redirect to login Page
if( $user)
{
       
    //Someone has an account with that Email
    header('location: /websites/demo/');
    die();
}else
{
    //Valid Email and not used
    //Save in database then log the user in and redirect

    $db->query('INSERT INTO users (`email`, `password`) values( :email, :password)', [
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ] );

    //Marke the user has logged in
    login($user);

    
    header('location: /websites/demo/');
    die();

}




// All is Clear save in DataBase






