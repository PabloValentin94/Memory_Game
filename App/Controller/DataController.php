<?php

namespace App\Controller;

use App\Model\DataModel;

use Exception;

class DataController extends Controller
{

    public static function LoadPage(string $option) : void
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
    
                $model->senha = md5((string) $_POST["senha_cadastro"]);
    
                $model->Save();
    
                header("Location: /form");
    
            }
    
            else if($_POST["opcao"] == "login")
            {
    
                $model->GetData($_POST["usuario_login"]);
    
                $player = $model->dados;
    
                if($player)
                {
    
                    if($_POST["usuario_login"] == $player[0]->nome_usuario
                       && md5((string) $_POST["senha_login"]) == $player[0]->senha)
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

            $model = new DataModel();

            $model->id = (int) $_SESSION["id_usuario"];

            $model->nome_jogador = $_SESSION["jogador"];

            $model->nome_usuario = $_SESSION["usuario"];

            $model->senha = $_SESSION["senha"];

            $model->recorde = $_POST["recorde"];

            unset($_SESSION["id_usuario"], $_SESSION["jogador"], $_SESSION["usuario"], $_SESSION["senha"]);

            $model->Save();

            header("Location: /form");

        }

        catch(Exception $ex)
        {

            exit($ex);

        }

    }

    public static function GenerateJSON() : void
    {

        try
        {

            $model = new DataModel();

            $model->GetData();

            if($model->dados)
            {

                parent::SendReturnAsJSON($model->dados);

            }

        }

        catch(Exception $ex)
        {

            exit($ex);

        }

    }

}

?>