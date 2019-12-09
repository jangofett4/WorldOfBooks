<?php
require "classes/WUserSession.php";

session_start();

(   
    isset($_POST["username"]) && 
    isset($_POST["password"]) 
) or die();

$username = $_POST["username"];
$password = $_POST["password"];

$session = new WUserSession($username, $password);

if ($session->login())
    $_SESSION["user_session"] = $session; // TODO: go back to index or landing page
else
    echo "Unable to log-in, go back to index";

?>