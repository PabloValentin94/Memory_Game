<?php

use App\Controller\DataController;

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{

    case "/":
        DataController::Load("Index");
    break;

    case "/form":
        DataController::Load("Form");
    break;

    case "/form/save":
        DataController::SaveData();
    break;

    case "/game":
        DataController::Load("Game");
    break;

    case "/game/save":
        DataController::SaveGame();
    break;

    case "/ranking":
        DataController::Load("Ranking");
    break;

}

?>