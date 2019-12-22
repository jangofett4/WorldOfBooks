<?php

require_once "libssn.php";

define("panelphp", "panel.php");

if (!isset($_POST["bookname"],
$_POST["author"],
$_POST["booktype"],
$_POST["publisher"],
$_POST["stock"],
$_POST["cost"],
$_POST["publishdate"],
$_POST["papercount"],
$_POST["language"],
$_POST["description"])) {
    header("Location: panel.php?emptyinput=1");
    exit();
}

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

if (!isset($_SESSION["panellogged"])) {
    LibSSN::set("restrict");
    header("Location: " . panelphp);
    exit();
}

require_once "libcon.php";

$uploaddir = "covers/";

$check = getimagesize($_FILES["bookcover"]["tmp_name"]);
if ($check !== false) {
    if ($_FILES["bookcover"]["size"] > 3 * 1024 * 1024) {
        LibSSN::set("imagetoobig");
        header("Location: " . panelphp);
        exit();
    }

    $ext = strtolower(pathinfo(basename($_FILES["bookcover"]["name"]), PATHINFO_EXTENSION));
    if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
        LibSSN::set("imagetyperr");
        header("Location: panel.php");
        exit();
    }

    $split = explode(' ', $bookname);
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

    try {
        $con = DSConnection::open_or_get();
        
        $key = $con->key("Books");
        $id = $key->pathEndIdentifier();
        
        $targetfile = $uploaddir . $id . '.' . $ext;
        
        $book = $con->entity($key, [
            "added" => date(DATE_RFC3339),
            "tags" => $tags,
            "name" => $bookname,
            "author" => $author,
            "type" => $type,
            "stock" => $stock,
            "cost" => $cost,
            "published" => $publishdate,
            "publisher" => $publisher,
            "papercount" => $paper,
            "language" => $lang,
            "description" => $desc,
            "coverpath" => $targetfile
        ], ["excludeFromIndexes" => ["stock", "published", "papercount", "description", "coverpath"]]);

        if (!move_uploaded_file($_FILES["bookcover"]["tmp_name"], $targetfile)) {
            LibSSN::set("uploaderr");
            header("Location: panel.php");
            exit();
        }
        $con->insert($book);
        LibSSN::set("bookadd");
        header("Location: " . panelphp);
        exit();
    } catch (Exception $e) {
        LibSSN::set("conerr");
        header("Location: " . panelphp);
        exit();
    }
} else {
    LibSSN::set("imagerr");
    header("Location: " . panelphp);
}
