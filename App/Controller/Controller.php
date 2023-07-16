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

    protected static function InputVerification(string $input) : bool
    {

        $quantidade_espacos_brancos = 0;

        for($i = 0; $i < strlen($input); $i++)
        {

            if($input[$i] == " ")
            {

                $quantidade_espacos_brancos++;
                
            }

        }

        if($quantidade_espacos_brancos == strlen($input))
        {

            return true;

        }

        else
        {

            return false;

        }

    }

    protected static function CPF_Validation($valor) : int
    {

        // Removendo símbolos especiais, caso exista, do CPF.

        $cpf = str_replace([".", ",", "+", "-", "E", "e"], "", $valor);

        // Verificando quantidade de algarismos do CPF.

        if(strlen($cpf) < 11 || strlen($cpf) > 11)
        {

            return 0;

        }

        else
        {

            // Verificando o CPF.

            $cpfs_automaticamente_invalidos = ["00000000000", "11111111111", "22222222222", "33333333333", "44444444444", "55555555555", "66666666666", "77777777777", "88888888888", "99999999999"];

            $condicao = true;

            foreach($cpfs_automaticamente_invalidos as $cpf_automaticamente_invalido)
            {

                if($cpf == $cpf_automaticamente_invalido)
                {

                    $condicao = false;

                    break;

                }

            }

            if(!$condicao)
            {

                return 1;

            }

            else
            {

                $pesos = [11, 10, 9, 8, 7, 6, 5, 4, 3, 2];

                // Calculando o primeiro dígito verificador.

                $resultados_primeira_verificacao = [];

                for($i = 0; $i < 9; $i++)
                {

                    array_push($resultados_primeira_verificacao, intval($cpf[$i]) * $pesos[$i + 1]);

                }

                $soma_resultados_primeira_verificacao = 0;

                foreach($resultados_primeira_verificacao as $resultado)
                {

                    $soma_resultados_primeira_verificacao += $resultado;

                }

                $primeiro_digito_verificador = 11 - ($soma_resultados_primeira_verificacao % 11);

                if($primeiro_digito_verificador >= 10)
                {

                    $primeiro_digito_verificador = 0;

                }

                // Calculando o segundo dígito verificador.

                $resultados_segunda_verificacao = [];

                for($i = 0; $i < 10; $i++)
                {

                    array_push($resultados_segunda_verificacao, intval($cpf[$i]) * $pesos[$i]);

                }

                $soma_resultados_segunda_verificacao = 0;

                foreach($resultados_segunda_verificacao as $resultado)
                {

                    $soma_resultados_segunda_verificacao += $resultado;

                }

                $segundo_digito_verificador = 11 - ($soma_resultados_segunda_verificacao % 11);

                if($segundo_digito_verificador >= 10)
                {

                    $segundo_digito_verificador = 0;

                }

                // Validando o CPF.

                if($primeiro_digito_verificador == intval($cpf[9]) && $segundo_digito_verificador == intval($cpf[10]))
                {

                    return 3;

                }

                else
                {

                    return 2;

                }

            }

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