<?php

spl_autoload_register(function($classe){

    $arquivo = BASEDIR . $classe . ".php";

    if(file_exists($arquivo))
    {

        include $arquivo;
        
    }

    else
    {

        exit("Arquivo não encontrado! Arquivo especificado: " . $arquivo);

    }

});

?>