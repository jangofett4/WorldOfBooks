<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";
require_once "libcon.php";

if (!LibSSN::getnd("logged"))
    die("ERR_NOT_LOGGED_IN");

if (!isset($_GET["book"], $_GET["rating"]))
    die("ERR_EMPTY_INPUT");

$bookid = $_GET["book"];
$rating = intval($_GET["rating"]);
$userid = LibSSN::getvnd("user_key");

if ($rating == 0 || $rating < 0 || $rating > 5)
    die("ERR_RATING");
    
$bought = LibSSN::getvnd("user_bought");
if (!isset($bought[$bookid]))
    die("ERR_NOT_BOUGHT");

try {
    $con = DSConnection::open_or_get();
    $key = $con->key("Books", $bookid);
    $book = $con->lookup($key);

    if (!isset($book["ratings"]))
        $book["ratings"] = array();
    if (!isset($book["totalrating"]))
        $book["totalrating"] = 0;
    if (!isset($book["totalrates"]))
        $book["totalrates"] = 0;

    $ratings = $book["ratings"];
    if (isset($ratings[$userid]))
    {
        $book["totalrating"] -= $ratings[$userid];
        $ratings[$userid] = $rating;
        $book["totalrating"] += $rating;
    }
    else
    {
        $book["totalrating"] += $rating;
        $ratings[$userid] = $rating;
        $book["totalrates"] += 1;
    }
    
    $book["ratings"] = $ratings;
    /** @var Entity $book */
    $con->update($book);
} catch (Exception $e) {
    die("ERR_CONNECTION");
}

