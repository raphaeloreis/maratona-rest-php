<?php
include '../../conexao/Conexao.php';

class Registro extends Conexao{
	   
    public function insert($obj){
    	$sql = "INSERT INTO registro(id_corredor,id_prova) VALUES (:id_corredor,:id_prova)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('id_corredor',  $obj->id_corredor);
        $consulta->bindValue('id_prova', $obj->id_prova);
    	return $consulta->execute();
	}

	public function update($obj,$id){
		$sql = "UPDATE registro SET id_corredor = :id_corredor, id_prova = :id_prova WHERE id = :id ";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id_corredor',  $obj->nome);
        $consulta->bindValue('id_prova', $obj->id_prova);
		$consulta->bindValue('id', $id);
		return $consulta->execute();
	}

	public function delete($id){
		$sql =  "DELETE FROM registro WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
	}

	public function find($id){
		$sql = "SELECT * FROM registro WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
        return $consulta->fetchAll();
	}

	public function findAll(){
		$sql = "SELECT * FROM registro";
		$consulta = Conexao::prepare($sql);
		$consulta->execute();
		return $consulta->fetchAll();
	}

    public function validaDado($obj){
		$a_obj = (array)$obj;
		foreach ($a_obj as $key => $value) {
			if (empty($value)) {
				$validacao['status'] = 'erro';
				$validacao['dados'] = "Campo $key vazio!";
				return $validacao;
			}
		}
	}

}

?>