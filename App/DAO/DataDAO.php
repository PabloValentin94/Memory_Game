<?php

namespace App\DAO;

use App\Model\DataModel;

class DataDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();

    }

    public function Insert(DataModel $model) : bool
    {

        $sql = "INSERT INTO Player(cpf, usuario, senha) VALUES(?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->cpf);

        $stmt->bindValue(2, $model->usuario);

        $stmt->bindValue(3, $model->senha);

        return $stmt->execute();

    }

    public function Update(DataModel $model) : bool
    {

        $sql = "UPDATE Player SET cpf = ?, usuario = ?, senha = ?, recorde = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->cpf);

        $stmt->bindValue(2, $model->usuario);

        $stmt->bindValue(3, $model->senha);

        $stmt->bindValue(4, $model->recorde);

        $stmt->bindValue(5, $model->id);

        return $stmt->execute();

    }

    public function Disable(int $id) : bool
    {

        $sql = "UPDATE Player SET ativo = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, false);

        $stmt->bindValue(2, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Player WHERE LENGTH(recorde) > 0 AND ativo = 1 ORDER BY recorde ASC, usuario ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\DataModel");

    }

    public function Search(string $valor_filtro, $valor_coluna) : array
    {

        $parametro = [":filtro" => "%" . $valor_filtro . "%"];

        $sql = "SELECT * FROM Player WHERE $valor_coluna LIKE :filtro AND ativo = 1 ORDER BY recorde ASC, usuario ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\DataModel");

    }

}

?>