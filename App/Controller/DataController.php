<?php

namespace App\Controller;

use App\Model\DataModel;

use Exception;

class DataController extends Controller
{

    public static function Load(string $option) : void
    {

        try
        {

            parent::ViewRenderer($option);

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

        }

    }

    public static function SaveData() : void
    {

        try
        {

            $model = new DataModel();

            if($_POST["opcao"] == "cadastro")
            {
    
                $model->nome_jogador = $_POST["jogador_cadastro"];
    
                $model->nome_usuario = $_POST["usuario_cadastro"];
    
                $model->senha = $_POST["senha_cadastro"];
    
                $model->Save();
    
                header("Location: /form");
    
            }
    
            else
            {
    
                $model->GetData($_POST["usuario_login"]);
    
                $player = $model->dados;
    
                if($player)
                {
    
                    if($_POST["usuario_login"] == $player[0]->nome_usuario
                       && md5($_POST["senha_login"]) == $player[0]->senha)
                    {
    
                        $_SESSION["id_usuario"] = $player[0]->id;
    
                        $_SESSION["jogador"] = $player[0]->nome_jogador;
    
                        $_SESSION["usuario"] = $player[0]->nome_usuario;
        
                        $_SESSION["senha"] = $player[0]->senha;
        
                        header("Location: /game");
    
                    }
    
                }
    
            }

        }

        catch(Exception $ex)
        {

            exit($ex);

        }

    }

    public static function SaveGame() : void
    {

        try
        {

            

        }

        catch(Exception $ex)
        {

            exit($ex);

        }

    }

}

?>