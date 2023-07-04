<?php

namespace App\Controller;

abstract class Controller
{

    protected static function ViewRenderer($view) : void
    {

        $arquivo = VIEWS . $view . ".html";

        if(file_exists($arquivo))
        {

            include $arquivo;

        }

        else
        {

            exit("Arquivo não encontrado! Arquivo especificado: " . $arquivo);

        }

    }

    protected static function SendReturnAsJSON($data) : void
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));

    }

}

?>