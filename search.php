<?php
require_once "vendor/autoload.php";

isset($_GET["query"]) or die();
$query = $_GET["query"];

$fuse = new \Fuse\Fuse([
    [
      "title" => "Old Man's War",
      "author" => "John Scalzi"
    ],
    [
      "title" => "The Lock Artist",
      "author" => "Steve Hamilton"
    ],
    [
      "title" => "HTML5",
      "author" => "Remy Sharp"
    ],
    [
      "title" => "Right Ho Jeeves",
      "author" => "P.D Woodhouse"
    ],
  ], [
    "keys" => ["title", "author"]
    ]
);

$searchresult = $fuse->search($query);
$json = json_encode($searchresult);
echo $json;