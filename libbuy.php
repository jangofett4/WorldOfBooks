<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";
require_once "libcon.php";

if (!LibSSN::getnd("logged"))
    die("ERR_NOT_LOGGED_IN");

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
        if (!isset($bought[$userid]))
            array_push($bought, $userid);
        if (!isset($userbought[$book]))
            array_push($userbought, $book);

        $bookent["bought"] = $bought;
        /** @var Entity $bookent */
        $con->update($bookent);

        array_push($buyhistory, [$book, $count]);
    }

    $user["cart"] = array();
    $user["bought"] = $userbought;
    $user["buyhistory"] = $buyhistory;
    
    /** @var Entity $user */
    $con->update($user);
    LibSSN::setv("user_cart", array());
} catch (Exception $e) {
    die("ERR_CONNECTION");
}