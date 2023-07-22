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

    protected static function CPF_Validation($value) : int
    {

        // Removendo símbolos especiais, caso exista, do CPF.

        $cpf = str_replace([".", ",", "+", "-", "E", "e"], "", $value);

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

    protected static function RecordVerification(string $old_record = null, string $new_record) : bool
    {

        if($old_record == null)
        {

            return true;

        }

        else
        {

            $recorde_atual = (int) str_replace(":", "", $old_record);

            $recorde_novo = (int) str_replace(":", "", $new_record);
    
            if($recorde_novo < $recorde_atual)
            {
    
                return true;
    
            }
    
            else
            {
    
                return false;
    
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

    protected static function GenerateBackup() : void
    {

        /* Observação: no comando exec são utilizadas simples, pois as aspas 
           duplas são usadas nos nomes de diretórios que possuam espaços contidos neles. */

        // Definindo a repartição utilizada.

        $reparticao = "C:";

        // Acessando a repartição definida.

        exec($reparticao);

        // Criando a pasta, caso não exista, onde os arquivos de backup serão salvos.

        if(!is_dir("$reparticao\Memory_Game_bl_Backup"))
        {

            exec('md ' . $reparticao . '\Memory_Game_bl_Backup');

        }

        // Definindo o fuso-horário brasileiro.

        date_default_timezone_set("America/Sao_Paulo");

        // Criando uma pasta, caso não exista, para os arquivos de backup do dia atual.

        $data_atual = strval(date("Y-m-d"));

        if(!is_dir("$reparticao\Memory_Game_bl_Backup\\" . $data_atual))
        {

            exec('md ' . $reparticao . '\Memory_Game_bl_Backup\\' . $data_atual);

        }

        // Criando uma pasta para os arquivos de backup do momento em esta função é acionada.

        $hora_atual = strval(date("H-i-s"));

        exec('md ' . $reparticao . '\Memory_Game_bl_Backup\\' . $data_atual . "\\" . $hora_atual);

        /*// Apagando os arquivos de backup já existentes, se houverem, para que os novos sejam criados.

        if(file_exists("$reparticao\Memory_Game_bl_Backup\Full_Backup.sql"))
        {

            exec('del ' . $reparticao . '\Memory_Game_bl_Backup\Full_Backup.sql');

        }

        if(file_exists("$reparticao\Memory_Game_bl_Backup\Structure_Backup.sql"))
        {

            exec('del ' . $reparticao . '\Memory_Game_bl_Backup\Structure_Backup.sql');

        }

        if(file_exists("$reparticao\Memory_Game_bl_Backup\Data_Backup.sql"))
        {

            exec('del ' . $reparticao . '\Memory_Game_bl_Backup\Data_Backup.sql');

        }*/

        // Criando os arquivos de backup.

        exec('C:\"Program Files"\MySQL\"MySQL Server 8.0"\bin\mysqldump -h' . substr($_ENV["database"]["host"], 0, 9) . ' -P' . substr($_ENV["database"]["host"], 10, 4) . ' -u' . $_ENV["database"]["user"] . ' -p' . $_ENV["database"]["password"] . ' ' . $_ENV["database"]["db_name"] . ' --databases > ' . $reparticao . '\Memory_Game_bl_Backup\\' . $data_atual . '\\' . $hora_atual . "\\" . 'Full_Backup.sql');

        exec('C:\"Program Files"\MySQL\"MySQL Server 8.0"\bin\mysqldump -h' . substr($_ENV["database"]["host"], 0, 9) . ' -P' . substr($_ENV["database"]["host"], 10, 4) . ' -u' . $_ENV["database"]["user"] . ' -p' . $_ENV["database"]["password"] . ' ' . $_ENV["database"]["db_name"] . ' --no-data --databases > ' . $reparticao . '\Memory_Game_bl_Backup\\' . $data_atual . '\\' . $hora_atual . "\\" . 'Structure_Backup.sql');

        exec('C:\"Program Files"\MySQL\"MySQL Server 8.0"\bin\mysqldump -h' . substr($_ENV["database"]["host"], 0, 9) . ' -P' . substr($_ENV["database"]["host"], 10, 4) . ' -u' . $_ENV["database"]["user"] . ' -p' . $_ENV["database"]["password"] . ' ' . $_ENV["database"]["db_name"] . ' --no-create-info --databases > ' . $reparticao . '\Memory_Game_bl_Backup\\' . $data_atual . '\\' . $hora_atual . "\\" . 'Data_Backup.sql');

    }

}

?>