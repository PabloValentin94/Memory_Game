<?php

use App\Controller\DataController;

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{

    case "/":
        DataController::LoadPage("Index");
    break;

    case "/form":
        DataController::LoadPage("Form");
    break;

    case "/form/save":
        DataController::SaveData();
    break;

    case "/game":
        DataController::LoadPage("Game");
    break;

    case "/game/save":
        DataController::SaveGame();
    break;

    case "/ranking":
        DataController::LoadPage("Ranking");
    break;

    case "/generate_json":
        DataController::GenerateJSON();
    break;

}

?>