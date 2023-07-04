<?php

namespace App\Model;

use App\DAO\DataDAO;

use Exception;

class DataModel extends Model
{

    public $id, $nome_jogador, $nome_usuario, $senha, $recorde;

    public function Save()
    {

        $dao = new DataDAO();

        empty($this->id) ? $dao->Insert($this) : $dao->Update($this);

        /*if(empty($this->id))
        {

            $dao->Insert($this);

        }

        else
        {

            $dao->Update($this);

        }*/

    }

    public function Erase(int $id)
    {

        (new DataDAO())->Delete($id);

    }

    public function GetData(string $filtro = null)
    {

        $dao = new DataDAO();

        $this->dados = ($filtro == null) ? $dao->Select() : $dao->Search($filtro);

        /*if($filtro == null)
        {

            $this->dados = $dao->Select();

        }

        else
        {

            $this->dados = $dao->Search($filtro);

        }*/

    }

}

?>