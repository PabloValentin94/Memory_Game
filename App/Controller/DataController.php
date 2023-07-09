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

                $model->GetData($model->usuario, "usuario");

                $usuarios = $model->dados;

                $model->GetData($model->cpf, "cpf");

                $cpfs = $model->dados;

                if(parent::InputVerification($_POST["cpf"]) ||
                   parent::InputVerification($_POST["usuario"]) ||
                   parent::InputVerification($_POST["senha"]))
                {

                    echo "<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>";

                }

                else
                {

                    if(count($usuarios) > 0 && count($cpfs) > 0)
                    {
    
                        echo "<script> alert('Este Usuário e CPF já estão cadastrados! Tente outras opções.'); " .
                             "history.pushState(null,null,'http://localhost:8000/form'); " .
                             "window.location.reload(true); </script>";
    
                    }
    
                    else if(count($usuarios) > 0)
                    {
    
                        echo "<script> alert('Este Usuário já está cadastrado! Tente outra opção.'); " .
                             "history.pushState(null,null,'http://localhost:8000/form'); " .
                             "window.location.reload(true); </script>";
    
                    }
    
                    else if(count($cpfs) > 0)
                    {
    
                        echo "<script> alert('Este CPF já está cadastrado! Tente outra opção.'); " .
                             "history.pushState(null,null,'http://localhost:8000/form'); " .
                             "window.location.reload(true); </script>";
    
                    }
    
                    else
                    {
    
                        $simbolos_especiais = [".", ",", "+", "-", "E", "e"];
        
                        $model->cpf = trim(str_replace($simbolos_especiais, "", $_POST["cpf"]));
            
                        $model->usuario = trim($_POST["usuario"]);
            
                        $model->senha = md5(trim($_POST["senha"]));
    
                        $model->Save();
    
                        header("Location: /form");
    
                    }

                }
    
            }
    
            else
            {

                if(parent::InputVerification($_POST["usuario"]) ||
                   parent::InputVerification($_POST["senha"]))
                {

                    echo "<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>";

                }

                else
                {

                    $model->GetData($_POST["usuario"], "usuario");
    
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

                        else
                        {

                            echo "<script> alert('Senha incorreta! Revise seus dados e tente novamente.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";

                        }
        
                    }
    
                    else
                    {

                        echo "<script> alert('Esse usuário não existe! Verifique se você realmente está cadastrado.'); " .
                             "history.pushState(null,null,'http://localhost:8000/form'); " .
                             "window.location.reload(true); </script>";
    
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