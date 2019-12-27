<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";
require_once "libcon.php";

if (!LibSSN::getnd("logged"))
{
    header("Location: index.php");
    exit();
}

$items = LibSSN::getvnd("user_cart");

try {
    $con = DSConnection::open_or_get();
    $userid = LibSSN::getvnd("user_key");
    $userkey = $con->key("UserInfo", $userid);
    $user = $con->lookup($userkey);

    if (!isset($user["buyhistory"]))
        $user["buyhistory"] = array();
    $buyhistory = $user["buyhistory"];
    
    if (!isset($user["bought"]))
        $user["bought"] = array();
    $userbought = $user["bought"];
    
    foreach ($items as $book => $count)
    {
        /** @var int $count */
        /** @var int $book */
        $key = $con->key("Books", $book);
        $bookent = $con->lookup($key);
        $bought = $bookent["bought"];
        if ($bought == null)
            $bought = array();  
        if (!isset($bought[$userid]))
            $bought[$userid] = 1;
        if (!isset($userbought[$book]))
            $userbought[$book] = 1;

        $bookent["bought"] = $bought;
        /** @var Entity $bookent */
        $con->update($bookent);

        array_push($buyhistory, (object)array("book" => $book, "count" => $count));
    }

    $user["cart"] = array();
    $user["bought"] = $userbought;
    $user["buyhistory"] = $buyhistory;
    LibSSN::setv("user_history", $buyhistory);
    
    /** @var Entity $user */
    $con->update($user);
    LibSSN::setv("user_cart", array());

    header("Location: pageBuyComplete.php");
    exit();
} catch (Exception $e) {
    LibSSN::set("ERR_CONNECTION");
    header("Location: pageCart.php");
    exit();
}