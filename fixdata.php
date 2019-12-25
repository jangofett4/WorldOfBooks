<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";
require_once "libcon.php";

function setifnotset(&$val, $idx, $to)
{
    if (!isset($val[$idx]))
        $val[$idx] = $to;
}

if (!isset($_SESSION["panellogged"]))
{    
    header("Location: index.php");
    exit();
}

$con = DSConnection::open_or_get();
$query = $con->query()
    ->kind("Books");
$result = $con->runQuery($query);

/** @var Entity $book */
foreach ($result as $book)
{
    setifnotset($book, "added", new DateTime());
    setifnotset($book, "tags", null);
    
    if ($book["tags"] == null)
    {
        $name = strtolower($book["name"]);
        $author = strtolower($book["author"]);

        $split = explode(' ', $name);
        $tags = array();
        foreach ($split as $word)
            if (strlen($word) < 3)
                array_push($tags, $word);
            else
                for ($i = 3; $i <= strlen($word); $i++)
                    array_push($tags, mb_substr($word, 0, $i));
        $split = explode(' ', $author);
        foreach ($split as $word)
            if (strlen($word) < 3)
                array_push($tags, $word);
            else
                for ($i = 3; $i <= strlen($word); $i++)
                    array_push($tags, mb_substr($word, 0, $i));
        $book["tags"] = $tags;
    }

    setifnotset($book, "ratings", array());
    setifnotset($book, "totalrating", 0);
    setifnotset($book, "totalrates", 0);

    $con->update($book);
}

$query = $con->query()
    ->kind("UserInfo");
$result = $con->runQuery($query);

foreach ($result as $user)
{
    setifnotset($user, "cart", array());
    setifnotset($user, "bought", array());
    setifnotset($user, "buyhistory", array());
    
    $con->update($user);
}