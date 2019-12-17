<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";

if (!isset($_SESSION["panellogged"]))
    die("ERR_RESTRICTED");

if (!isset($_POST["book"], $_POST["count"]))
    die("ERR_EMPTY_INPUT");

require_once "libcon.php";

$con = DSConnection::open_or_get();
$key = $con->key("Books", $_POST["book"]);
$book = $con->lookup($key);

$c_stock = intval($book["stock"]);
$p_stock = intval($_POST["count"]);

if ($p_stock < 0 && $c_stock < abs($p_stock))
    die("ERR_NOT_ENOUGH_BOOK");

$c_stock += $p_stock;
$book["stock"] = $c_stock;
/** @var Entity $book */
$con->update($book);