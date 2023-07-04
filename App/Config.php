<?php

define("BASEDIR", dirname(__FILE__, 2) . "/");

define("VIEWS", dirname(__FILE__) . "/View/Modules/");

$_ENV["database"]["host"] = "localhost:3306";
$_ENV["database"]["user"] = "root";
$_ENV["database"]["password"] = "etecjau";
$_ENV["database"]["db_name"] = "db_memory_game_bl";

?>