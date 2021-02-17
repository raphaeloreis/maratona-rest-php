<?php
header('Content-Type: application/json; charset=utf-8');

class Rest
{
	public static function open($requisicao)
	{
		$url = explode('/', $requisicao['url']);
		
		$classe = ucfirst($url[0]);
		array_shift($url);

		$parametros = array();
		$parametros = $url;
		$erro = array();

		require_once 'model/'.$classe.'.php';

		$tipo_requisicao = $_SERVER['REQUEST_METHOD'];

		if($tipo_requisicao=='GET'){
			if($classe == 'Listagem'){
				$retorno = call_user_func_array(array(new $classe, $parametros[0]), array());
			}else{
				@$id = $parametros[0];
				if($id>0){
					$retorno = call_user_func_array(array(new $classe, 'find'), $parametros);
				}else{
					$retorno = call_user_func_array(array(new $classe, 'findAll'),$parametros);
				}
	
				if(!$retorno){
					$erro['status'] = 'erro';
					$erro['dados'] = "Registro $id do objeto $classe não localizado";
				}
			}
		}elseif ($tipo_requisicao=='POST') {
			
			$json = file_get_contents('php://input');
			$post = json_decode($json);

			$erro = call_user_func_array(array(new $classe, 'validaDado'), array($post));
			if(!$erro){
				$retorno = call_user_func_array(array(new $classe, 'insert'), array($post));
			}

		}elseif($tipo_requisicao=='PUT'){
			$json = file_get_contents('php://input');
			$post = json_decode($json);
			
			if($parametros[0]>0){
				$id = $parametros[0];

				$erro = call_user_func_array(array(new $classe, 'validaDado'), array($post));
				if(!$erro){
					$registro = call_user_func_array(array(new $classe, 'find'), $parametros);
					if(empty($registro)) { 
						$erro['status'] = 'erro';
						$erro['dados'] = "Registro $id do objeto $classe não localizado";
					}else{
						
						$retorno = call_user_func_array(array(new $classe, 'update'), array($post,$id));
						
					}
				}
			}
		}elseif($tipo_requisicao=='DELETE'){
			
			@$id = $parametros[0];
			if($id>0){
				$registro = call_user_func_array(array(new $classe, 'find'), $parametros);
				if(empty($registro)) { 
					$erro['status'] = 'erro';
					$erro['dados'] = "Registro $id do objeto $classe não localizado";	
				}else{
					$retorno = call_user_func_array(array(new $classe, 'delete'), array($id));
					
				}
			}
		}
		if($erro){
			return json_encode($erro);
		}else{
			return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
		}
		exit;
		
		try {
			if (class_exists($classe)) {
				
				
				
				if (method_exists($classe, $metodo)) {
					$retorno = call_user_func_array(array(new $classe, $metodo), $parametros);

					return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
				} else {
					return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
				}
			} else {
				return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
		}
		
	}
}

if (isset($_REQUEST)) {
	echo Rest::open($_REQUEST);
}