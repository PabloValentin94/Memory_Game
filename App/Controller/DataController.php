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

                $simbolos_especiais = [".", ",", "+", "-", "E", "e"];
    
                $model->cpf = trim(str_replace($simbolos_especiais, "", $_POST["cpf"]));
    
                $model->usuario = trim($_POST["usuario"]);
    
                $model->senha = md5(trim($_POST["senha"]));
    
                $model->Save();
    
                header("Location: /form");
    
            }
    
            else
            {
    
                $model->GetData($_POST["usuario"]);
    
                $player = $model->dados;
    
                if($player)
                {
    
                    if($_POST["usuario"] == $player[0]->usuario &&
                       md5($_POST["senha"]) == $player[0]->senha)
                    {
    
                        $_SESSION["id_usuario"] = $player[0]->id;
    
                        $_SESSION["cpf"] = $player[0]->cpf;
    
                        $_SESSION["usuario"] = $player[0]->usuario;
        
                        $_SESSION["senha"] = $player[0]->senha;
        
                        header("Location: /game");
    
                    }
    
                }
    
            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

        }

    }

    public static function SaveGame() : void
    {

        try
        {

            $model = new DataModel();

            $model->id = (int) $_SESSION["id_usuario"];

            $model->cpf = $_SESSION["cpf"];

            $model->usuario = $_SESSION["usuario"];

            $model->senha = $_SESSION["senha"];

            $model->recorde = $_POST["recorde"];

            unset($_SESSION["id_usuario"], $_SESSION["cpf"], $_SESSION["usuario"], $_SESSION["senha"]);

            $model->Save();

            header("Location: /form");

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

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

            exit("Erro: " . $ex);

        }

    }

}

?>