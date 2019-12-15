<?php

use Google\Cloud\Datastore\Entity;

require_once "libssn.php";
require_once "libcon.php";

if (!isset($_SESSION["panellogged"]))
{
    LibSSN::set("restrict");
    header("Location: panel.php");
    exit();
}

$con = DSConnection::open_or_get();
$query = $con->query()
    ->kind("Books");
$result = $con->runQuery($query);

/** @var Entity $book */
foreach ($result as $book)
{
    if (!isset($book["added"]))
    {
        $book["added"] = new DateTime();
    }
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
    $con->update($book);
}