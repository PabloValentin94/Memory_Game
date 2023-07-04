<?php

namespace App\Controller;

abstract class Controller
{

    protected static function ViewRenderer($view, $model = null) : void
    {

        $arquivo = VIEWS . $view . ".php";

        if(file_exists($arquivo))
        {

            include $arquivo;

        }

        else
        {

            exit("Arquivo não encontrado! Arquivo especificado: " . $arquivo);

        }

    }

}

?>