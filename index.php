<?php
// authors: Alex Chan, Nathaniel Gonzalez, & Cory Ooten

    session_start();

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// Parse the query string for command
$command = "login";
if (isset($_GET["command"])) {
    $command = $_GET["command"];
}

if (isset($_POST["command"])){
    $command = $_POST["command"];
}

// If the user's email is not set in the session, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!
if (!isset($_SESSION["email"])) {
    // they need to see the login
    $command = "login";
}

// Instantiate the controller and run
$site = new ClothingSiteController($command);

$site->run();