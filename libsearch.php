<?php

use Google\Cloud\Datastore\Entity;

require_once "vendor/autoload.php";
require_once "libcon.php";
require_once "libssn.php";

isset($_GET["query"]) or die();
$search = $_GET["query"];

$split = explode(' ', $search);
$results = array();

$books = array();
try {
    $con = DSConnection::open_or_get();
    foreach ($split as $word)
    {
        $word = strtolower($word);
        $query = $con->query()
            ->kind("Books")
            ->filter("tags", "=", $word);
        $result = $con->runQuery($query);
    
        /** @var Entity $book */
        foreach ($result as $book)
        {
            $key = $book->key()->pathEndIdentifier();
            if (!isset($results[$key]))
            {
                $results[$key] = true;
                array_push($books, [
                    "added" => $book["date"],
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
            }
        }
    }
} catch (Exception $e) {
}

if (!isset($_GET["dedicated"]))
{
    echo json_encode($books);
}