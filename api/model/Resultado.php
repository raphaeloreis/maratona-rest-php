<?php
include 'conexao/Conexao.php';

class Resultado extends Conexao
{

    public function insert($obj)
    {
        $sql = "INSERT INTO resultado(id_corredor,id_prova,hora_inicio,hora_conclusao) VALUES (:id_corredor, :id_prova, :hora_inicio, :hora_conclusao)";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id_corredor', $obj->id_corredor);
        $consulta->bindValue('id_prova', $obj->id_prova);
        $consulta->bindValue('hora_inicio', $obj->hora_inicio);
        $consulta->bindValue('hora_conclusao', $obj->hora_conclusao);
        return $consulta->execute();
    }

    public function update($obj, $id)
    {
        $sql = "UPDATE resultado SET id_corredor = :id_corredor, id_prova = :id_prova, hora_inicio = :hora_inicio, hora_conclusao = :hora_conclusao WHERE id = :id ";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id_corredor', $obj->id_corredor);
        $consulta->bindValue('id_prova', $obj->id_prova);
        $consulta->bindValue('hora_inicio', $obj->hora_inicio);
        $consulta->bindValue('hora_conclusao', $obj->hora_conclusao);
        $consulta->bindValue('id', $id);
        return $consulta->execute();
    }

    public function delete($obj, $id)
    {
        $sql = "DELETE FROM resultado WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id', $id);
        $consulta->execute();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM resultado WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id', $id);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM resultado";
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
