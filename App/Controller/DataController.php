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

    public static function RegisterUser() : void
    {

        try
        {

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

                $model = new DataModel();

                $model->GetData($_POST["usuario"], "usuario");

                $usuarios = $model->dados;

                if($usuarios)
                {

                    $condicao = 0;

                    foreach($usuarios as $item)
                    {
    
                        if($item->usuario == $_POST["usuario"] && $item->cpf == $_POST["cpf"])
                        {
    
                            $condicao = 1;
    
                            break;
    
                        }
    
                        else if($item->usuario == $_POST["usuario"])
                        {
    
                            $condicao = 2;
    
                            break;
    
                        }
    
                        else if($item->cpf == $_POST["cpf"])
                        {
    
                            $condicao = 3;
    
                            break;
    
                        }
    
                    }
    
                    switch($condicao)
                    {

                        case 0:
    
                            $simbolos_especiais = [".", ",", "+", "-", "E", "e"];
    
                            $model->cpf = trim(str_replace($simbolos_especiais, "", $_POST["cpf"]));
                
                            $model->usuario = trim($_POST["usuario"]);
                
                            $model->senha = md5(trim($_POST["senha"]));
    
                            $model->Save();
    
                            header("Location: /form");
    
                        break;
    
                        case 1:
    
                            echo "<script> alert('Este Usuário e CPF já estão cadastrados! Tente outras opções.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";
    
                        break;
    
                        case 2:
    
                            echo "<script> alert('Este Usuário já está cadastrado! Tente outra opção.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";
    
                        break;
    
                        case 3:
    
                            echo "<script> alert('Este CPF já está cadastrado! Tente outra opção.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";
    
                        break;
    
                    }

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

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

        }

    }

    public static function EditUser() : void
    {

        try
        {

            if(parent::InputVerification($_POST["usuario"]) ||
               parent::InputVerification($_POST["senha"]) ||
               parent::InputVerification($_POST["usuario_novo"]) ||
               parent::InputVerification($_POST["senha_nova"]))
            {

                echo "<script> alert('Não são permitidos campos preenchidos somente com espaços! Revise seus dados e tente novamente.'); " .
                     "history.pushState(null,null,'http://localhost:8000/form'); " .
                     "window.location.reload(true); </script>";

            }

            else
            {

                $model = new DataModel();

                $model->GetData($_POST["usuario"], "usuario");

                $usuarios = $model->dados;

                if($usuarios)
                {

                    $condicao = 0;

                    $id_player = 0;

                    foreach($usuarios as $item)
                    {

                        if($_POST["usuario"] == $item->usuario &&
                        md5($_POST["senha"]) == $item->senha)
                        {
        
                            if($_POST["usuario_novo"] == $item->usuario)
                            {

                                $condicao = 1;

                            }

                            else
                            {

                                $condicao = 2;

                                $id_player = $item->id - 1;

                                break;

                            }
        
                        }

                    }

                    switch($condicao)
                    {

                        case 0:

                            echo "<script> alert('Usuário ou senha incorretos! Revise seus dados e tente novamente.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";

                        break;

                        case 1:

                            echo "<script> alert('Já existe um usuário com esse nome! Tente outra opção.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";

                        break;

                        case 2:

                            $model->id = (int) $usuarios[$id_player]->id;

                            $model->cpf = $usuarios[$id_player]->cpf;

                            $model->usuario = trim($_POST["usuario_novo"]);
            
                            $model->senha = md5(trim($_POST["senha_nova"]));

                            $model->recorde = $usuarios[$id_player]->recorde;

                            $model->Save();

                            header("Location: /form");

                        break;

                    }

                }

                /*else
                {

                    echo "<script> alert('Esse usuário não existe! Verifique se você realmente está cadastrado.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>";

                }*/

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

        }

    }

    public static function DeactivateUser() : void
    {

        try
        {

            $model = new DataModel();

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

        }

    }

    public static function LoginUser() : void
    {

        try
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

                $model = new DataModel();

                $model->GetData($_POST["usuario"], "usuario");

                $usuarios = $model->dados;

                if($usuarios)
                {

                    $condicao = 0;

                    $id_player = 0;

                    foreach($usuarios as $item)
                    {

                        if($_POST["usuario"] == $item->usuario &&
                        md5($_POST["senha"]) == $item->senha)
                        {

                            $condicao = 1;
    
                            $id_player = $item->id - 1;

                            break;
    
                        }

                    }

                    switch($condicao)
                    {

                        case 0:

                            echo "<script> alert('Usuário ou senha incorretos! Revise seus dados e tente novamente.'); " .
                                 "history.pushState(null,null,'http://localhost:8000/form'); " .
                                 "window.location.reload(true); </script>";

                        break;

                        case 1:

                            $_SESSION["id_usuario"] = $usuarios[$id_player]->id;
    
                            $_SESSION["cpf"] = $usuarios[$id_player]->cpf;
    
                            $_SESSION["usuario"] = $usuarios[$id_player]->usuario;
            
                            $_SESSION["senha"] = $usuarios[$id_player]->senha;
            
                            header("Location: /game");

                        break;

                    }

                }

                /*else
                {

                    echo "<script> alert('Esse usuário não existe! Verifique se você realmente está cadastrado.'); " .
                         "history.pushState(null,null,'http://localhost:8000/form'); " .
                         "window.location.reload(true); </script>";

                }*/

            }

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

            if($_POST["opcao"] == "cadastro")
            {

                self::RegisterUser();
    
            }

            else if($_POST["opcao"] == "edicao")
            {

                self::EditUser();

            }

            else if($_POST["opcao"] == "desativacao")
            {

                self::DeactivateUser();

            }
    
            else
            {

                self::LoginUser();
    
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

            else
            {

                parent::SendReturnAsJSON("Nada a retornar.");

            }

        }

        catch(Exception $ex)
        {

            exit("Erro: " . $ex);

        }

    }

}

?>