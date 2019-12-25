<?php

require_once "libcon.php";

session_start();

if (isset($_SESSION["logged"]))
    die("ERR_ALREADY_LOGGED"); // TODO: might send to main page instead

isset(
    $_POST["email"],
    $_POST["password"],
    $_POST["name"],
    $_POST["surname"]
) or die("ERR_EMPTY_INPUT");

// fields
$email      = $_POST["email"];
$password   = $_POST["password"];
$name       = $_POST["name"];
$surname    = $_POST["surname"];

$con = DSConnection::open_or_get();

$user = $con->query()
    ->kind("UserInfo")
    ->filter("email", "=", $email);
$result = $con->runQuery($user);
(iterator_count($result) == 0) or die("ERR_USER_EXISTS");

$user = $con->entity("UserInfo");
$user->set([
    "email"     => $email,
    "password"  => $password,
    "name"      => $name,
    "surname"   => $surname,
    "cart"      => array(),
    "bought"    => array(),
    "buyhistory"=> array(),
]);
$con->insert($user);

$_SESSION["user_key"] = $user->key();
$_SESSION["user_name"] = $user["name"];
$_SESSION["user_surname"] = $user["surname"];
$_SESSION["user_email"] = $user["email"];
$_SESSION["user_password"] = $user["password"];
$_SESSION["logged"] = true;
?>