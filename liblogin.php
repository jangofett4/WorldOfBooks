<?php
require_once "libcon.php";

session_start();

isset($_POST["username"], $_POST["password"]) or die("");

$username = $_POST["username"];
$password = $_POST["password"];

$con = DSConnection::open_or_get();
$query = $con->query()
    ->kind("UserInfo")
    ->filter("username", "=", $username)
    ->filter("password", "=", $password);
$result = $con->runQuery($query);

(count($result) == 1) or die(); // should return single value

$user = $result[0];
echo($user["username"] . "<br/>");
echo($user["password"] . "<br/>");
echo($user["name"] . "<br/>");
echo($user["surname"] . "<br/>");
?>