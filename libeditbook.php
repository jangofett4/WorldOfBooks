<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";

define("panelphp", "panel.php");

if (!isset(
    $_POST["bookname"], 
    $_POST["author"], 
    $_POST["booktype"], 
    $_POST["publisher"], 
    $_POST["stock"], 
    $_POST["cost"], 
    $_POST["publishdate"], 
    $_POST["papercount"], 
    $_POST["language"], 
    $_POST["description"],
    $_POST["book"])) {
    die("ERR_EMPTY_INPUT");
}

$id = $_POST["book"];
$bookname = $_POST["bookname"];
$author = $_POST["author"];
$type = $_POST["booktype"];
$publisher = $_POST["publisher"];
$stock = $_POST["stock"];
$cost = $_POST["cost"];
$publishdate = $_POST["publishdate"];
$paper = $_POST["papercount"];
$lang = $_POST["language"];
$desc = $_POST["description"];

if (!isset($_SESSION["panellogged"]))
    die("ERR_RESTRICT");

require_once "libcon.php";

$split = explode(' ', strtolower($bookname));
$tags = array();
foreach ($split as $word)
    if (strlen($word) < 3)
        array_push($tags, $word);
    else
        for ($i = 3; $i <= strlen($word); $i++)
            array_push($tags, mb_substr($word, 0, $i));
$split = explode(' ', strtolower($author));
foreach ($split as $word)
    if (strlen($word) < 3)
        array_push($tags, $word);
    else
        for ($i = 3; $i <= strlen($word); $i++)
            array_push($tags, mb_substr($word, 0, $i));
            
try {
    $con = DSConnection::open_or_get();
    $key = $con->key("Books", $id);
    $book = $con->lookup($key);
    
    $book["tags"] = $tags;
    $book["name"] = $bookname;
    $book["author"] = $author;
    $book["type"] = $type;
    $book["stock"] = $stock;
    $book["cost"] = $cost;
    $book["published"] = $publishdate;
    $book["publisher"] = $publisher;
    $book["papercount"] = $paper;
    $book["language"] = $lang;
    $book["description"] = $desc;

    /** @var Entity $book */
    $con->update($book);
    exit();
} catch (Exception $e) {
    die("ERR_CONNECTION");
}
