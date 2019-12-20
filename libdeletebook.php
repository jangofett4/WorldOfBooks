<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";

if (!isset($_POST["book"]))
    die("ERR_EMPTY_INPUT");

if (!LibSSN::getnd("panellogged"))
    die("ERR_RESTRICT");

require_once "libcon.php";

try {
    $con = DSConnection::open_or_get();
    $id = $_POST["book"];
    $key = $con->key("Books", $id);
    $book = $con->lookup($key);
    if (!unlink($book["coverpath"]))
        die("ERR_DELETE_COVER");
    $con->delete($key);
} catch (Exception $e) {
    die("ERR_CONNECTION");
}