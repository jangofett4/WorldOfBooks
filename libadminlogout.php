<?php
require_once "libssn.php";
isset($_SESSION["panellogged"]) or die();
unset($_SESSION["panellogged"]);