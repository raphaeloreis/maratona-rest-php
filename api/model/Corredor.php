<?php
include_once 'conexao/Conexao.php';

class Corredor extends Conexao
{

    public function insert($obj)
    {

        $sql = "INSERT INTO corredor(nome,cpf,nascimento) VALUES (:nome,:cpf,:nascimento)";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('nome', $obj->nome);
        $consulta->bindValue('cpf', $obj->cpf);
        $consulta->bindValue('nascimento', $obj->nascimento);
        return $consulta->execute();
    }

    public function update($obj, $id = null)
    {
        $sql = "UPDATE corredor SET nome = :nome, cpf = :cpf, nascimento = :nascimento WHERE id = :id ";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('nome', $obj->nome);
        $consulta->bindValue('cpf', $obj->cpf);
        $consulta->bindValue('nascimento', $obj->nascimento);
        $consulta->bindValue('id', $id);
        return $consulta->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM corredor WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id', $id);
        $consulta->execute();
        return $consulta->execute();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM corredor WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id', $id);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM corredor";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function validaDado($obj)
    {
        $a_obj = (array) $obj;
        foreach ($a_obj as $key => $value) {
            if (empty($value)) {
                $erro['status'] = 'erro';
                $erro['dados'] = "Campo $key vazio!";
                return $erro;
            }
        }

        $idade = date_diff(date_create($obj->nascimento), date_create(date("Y-m-d")));
        if ($idade->format('%y') < 18) {
            $erro['status'] = 'erro';
            $erro['dados'] = "Corredor menor de idade!";
            return $erro;
        }

    }

}
