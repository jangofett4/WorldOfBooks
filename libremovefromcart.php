<?php

require_once "libcart.php";

if (!isset($_GET["book"]))
    die("ERR_EMPTY_INPUT");

$bookid = $_GET["book"];

try {
    LibCart::init();
    LibCart::remove($bookid);
} catch (\Throwable $th) {
    die("ERR_CONNECTION");
}