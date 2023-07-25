<?php

// Namespace desta classe.

namespace App\Model;

// Namespaces utilizados nesta classe.

use App\DAO\DataDAO;

class DataModel extends Model
{

    public $id, $cpf, $usuario, $senha, $recorde, $ativo;

    public function Save() : void
    {

        $dao = new DataDAO();

        (empty($this->id)) ? $dao->Insert($this) : $dao->Update($this);

        /*if(empty($this->id))
        {

            $dao->Insert($this);

        }

        else
        {

            $dao->Update($this);

        }*/

    }

    public function Erase(int $id) : void
    {

        (new DataDAO())->Disable($id);

    }

    public function GetData(string $filtro = null, string $coluna = null) : void
    {

        $dao = new DataDAO();

        $this->dados = ($filtro == null && $coluna == null) ? $dao->Select() : $dao->Search($filtro, $coluna);

        /*if($filtro == null && $coluna == null)
        {

            $this->dados = $dao->Select();

        }

        else
        {

            $this->dados = $dao->Search($filtro, $coluna);

        }*/

    }

}

?>