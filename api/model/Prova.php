<?php
include_once 'conexao/Conexao.php';

class Prova extends Conexao
{

    public function insert($obj)
    {
        $sql = "INSERT INTO prova(tipo,data) VALUES (:tipo,:data)";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('tipo', $obj->tipo);
        $consulta->bindValue('data', $obj->data);
        return $consulta->execute();
    }

    public function update($obj, $id)
    {
        $sql = "UPDATE prova SET tipo = :tipo, data = :data WHERE id = :id ";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('tipo', $obj->tipo);
        $consulta->bindValue('data', $obj->data);
        $consulta->bindValue('id', $id);
        return $consulta->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM prova WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id', $id);
        $consulta->execute();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM prova WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id', $id);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM prova";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function validaDado($obj)
    {
        $a_obj = (array) $obj;
        foreach ($a_obj as $key => $value) {
            if (empty($value)) {
                $validacao['status'] = 'erro';
                $validacao['dados'] = "Campo $key vazio!";
                return $validacao;
            }
        }

    }

}
