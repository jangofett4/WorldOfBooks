<?php

require_once "libcart.php";

if (!isset($_GET["book"], $_GET["count"]))
    die("ERR_EMPTY_INPUT");

$bookid = $_GET["book"];
$count = $_GET["count"];

LibCart::init();
LibCart::add($bookid, $count);