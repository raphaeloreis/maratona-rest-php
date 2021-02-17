<?php
include_once 'conexao/Conexao.php';

class Registro extends Conexao{
	   
    public function insert($obj){
    	$sql = "INSERT INTO registro(id_corredor,id_prova) VALUES (:id_corredor,:id_prova)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('id_corredor', $obj->id_corredor);
        $consulta->bindValue('id_prova', $obj->id_prova);
    	return $consulta->execute();
	}

	public function update($obj,$id){
		$sql = "UPDATE registro SET id_corredor = :id_corredor, id_prova = :id_prova WHERE id = :id ";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id_corredor', $obj->id_corredor);
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
				$erro['status'] = 'erro';
				$erro['dados'] = "Campo $key vazio!";
				return $erro;
			}
		}
		
		include 'Prova.php';

		$prova = new Prova;
		$dados_prova = $prova->find($obj->id_prova);
		$dia = $dados_prova[0]->data;
		
		$sql = "SELECT count(*) as total_prova_dias, prova.data FROM registro,prova 
			WHERE registro.id_corredor = :id_corredor AND prova.id = registro.id_prova 
			AND prova.data = '$dia' GROUP BY prova.data";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id_corredor', $obj->id_corredor);
		$consulta->execute();
		$array_dados = $consulta->fetch(PDO::FETCH_ASSOC);
		if(@$array_dados['total_prova_dias'] > 0){
			$erro['status'] = 'erro';
			$erro['dados'] = "O corredor já tem um prova cadastrada para o dia $dia!";
			return $erro;
		}

	}

}

?>