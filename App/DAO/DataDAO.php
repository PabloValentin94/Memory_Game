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

        $sql = "INSERT INTO Player(nome_jogador, nome_usuario, " .
               "senha) VALUES(?, ?, md5(?))";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome_jogador);

        $stmt->bindValue(2, $model->nome_usuario);

        $stmt->bindValue(3, $model->senha);

        return $stmt->execute();

    }

    public function Update(DataModel $model) : bool
    {

        $sql = "UPDATE Player SET nome_jogador = ?, nome_usuario = ?, " .
               "senha = md5(?), recorde = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome_jogador);

        $stmt->bindValue(2, $model->nome_usuario);

        $stmt->bindValue(3, $model->senha);

        $stmt->bindValue(4, $model->recorde);

        $stmt->bindValue(5, $model->id);

        return $stmt->execute();

    }

    public function Delete(int $id) : bool
    {

        $sql = "DELETE FROM Player WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Player ORDER BY recorde DESC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\DataModel");

    }

    public function Search(string $valor) : array
    {

        $parametro = [":filtro" => "%" . $valor . "%"];

        $sql = "SELECT * FROM Player WHERE nome_usuario " .
               "LIKE :filtro ORDER BY recorde DESC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\DataModel");

    }

}

?>