<?php

use Google\Cloud\Datastore\Entity;

require_once "libcon.php";
require_once "libcart.php";
require_once "libssn.php";

(!isset($_SESSION["logged"])) or die("ERR_ALREADY_LOGGED");

isset($_POST["email"], $_POST["password"]) or die("ERR_EMPTY_INPUT");

$email = $_POST["email"];
$password = $_POST["password"];

$con = DSConnection::open_or_get();
$query = $con->query()
    ->kind("UserInfo")
    ->filter("email", "=", $email)
    ->filter("password", "=", $password);
$result = $con->runQuery($query);

(iterator_count($result) == 1) or die("ERR_USER_NOT_EXISTS"); // should return single value

/** @var Entity $userdata */
foreach ($result as $userdata)
{
    $_SESSION["user_key"] = $userdata->key()->pathEndIdentifier();
    $_SESSION["user_name"] = $userdata["name"];
    $_SESSION["user_surname"] = $userdata["surname"];
    $_SESSION["user_email"] = $userdata["email"];
    $_SESSION["user_password"] = $userdata["password"];
    $_SESSION["user_cart"] = $userdata["cart"];
    $_SESSION["logged"] = true;

    LibCart::init(); // add previously added items into users cart
    break;
}

?>