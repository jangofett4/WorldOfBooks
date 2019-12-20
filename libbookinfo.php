<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";
require_once "libcon.php";

if (!LibSSN::getnd("panellogged"))
    die("ERR_RESTRICT");

if (!isset($_POST["book"]))
    die("ERR_EMPTY_INPUT");

try {
    $con = DSConnection::open_or_get();
    $key = $con->key("Books", $_POST["book"]);
    /** @var Entity $book */
    $book = $con->lookup($key);
    header("Content-Type: text/json");
    echo json_encode([
        "name" => $book["name"],
        "author" => $book["author"],
        "type" => $book["type"],
        "stock" => $book["stock"],
        "cost" => $book["cost"],
        "published" => $book["published"],
        "publisher" => $book["publisher"],
        "papercount" => $book["papercount"],
        "language" => $book["language"],
        "description" => $book["description"],
        "coverpath" => $book["coverpath"]
    ]);
} catch (Exception $e) {
    die("ERR_CONNECTION");
}