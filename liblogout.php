<?php
require_once "libssn.php";
isset($_SESSION["logged"]) or die();
unset($_SESSION["logged"]);
// yep, this is the entire logout script