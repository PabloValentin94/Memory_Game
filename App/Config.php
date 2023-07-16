<?php

define("BASEDIR", dirname(__FILE__, 2) . "/");

define("VIEWS", dirname(__FILE__) . "/View/Modules/");

// Senha Mestra:
define("MASTER", "a6facc54aeeb0ee2d5e0c01d17074b77");

$_ENV["database"]["host"] = "localhost:3306";
$_ENV["database"]["user"] = "root";
$_ENV["database"]["password"] = "etecjau";
$_ENV["database"]["db_name"] = "db_memory_game_bl";

?>