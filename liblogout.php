<?php
session_start();
isset($_SESSION["logged"]) or die();
unset($_SESSION["logged"]);
// yep, this is the entire logout script