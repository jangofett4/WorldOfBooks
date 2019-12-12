<?php
require_once "vendor/autoload.php";
require_once "libcon.php";

isset(
    $_POST["username"],
    $_POST["password"],
    $_POST["password2"], 

    $_POST["name"],
    $_POST["surname"],

    $_POST["email"],
    $_POST["email2"]
) or die("Ana sayfaya dönmek için <a href='index.php'>tıklayın</a>");

// fields
$username   = $_POST["username"];
$password   = $_POST["password"];
$name       = $_POST["name"];
$surname    = $_POST["surname"];
$email      = $_POST["email"];

// confirmations
$password2 = $_POST["password2"];
$email2 = $_POST["email2"];

($password == $password2) or die("Ana sayfaya dönmek için <a href='index.php'>tıklayın</a>");
($email == $email2) or die("Ana sayfaya dönmek için <a href='index.php'>tıklayın</a>");

$con = DSConnection::open_or_get();
$user = $con->entity("UserInfo");
$user->set([
    "username"  => $username,
    "password"  => $password,
    "name"      => $name,
    "surname"   => $surname,
    "email"     => $email
]);
$con->insert($user);
?>