<?php

require_once("config/db.php");

// class autoloader function, this includes all the classes that are needed by the script
// you can remove this stuff if you want to include your files manually
function autoload($class)
{
    require('classes/' . $class . '.class.php');
}

// automatically loads all needed classes, when they are needed
spl_autoload_register("autoload");


//create a database connection
$db    = new Database();

// start this baby and give it the database connection
$login = new Login($db);

// base structure
if ($login->displayRegisterPage()) {
        include("views/login/register.php");
} else {
    // are we logged in ?
    if ($login->isUserLoggedIn()) {
        header( 'Location: form.php' );
    } else {
        // not logged in, showing the login form
        include("views/login/not_logged_in.php");
    }
}
