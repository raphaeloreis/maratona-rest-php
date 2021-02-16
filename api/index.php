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

		require_once 'model/'.$classe.'.php';

		$tipo_requisicao = $_SERVER['REQUEST_METHOD'];

		if($tipo_requisicao=='GET'){
			if($parametros[0]>0){
				$id = $parametros[0];
				$retorno = call_user_func_array(array(new $classe, 'find'), $parametros);
			}else{
				$retorno = call_user_func_array(array(new $classe, 'findAll'),$parametros);
			}
		}elseif ($tipo_requisicao=='POST') {
			
			$json = file_get_contents('php://input');
			$post = json_decode($json);

			$valida = call_user_func_array(array(new $classe, 'validaDado'), array($post));
			if(!$valida){
				$retorno = call_user_func_array(array(new $classe, 'insert'), array($post));
			}else{
				$retorno = $valida;
			}

		}elseif($tipo_requisicao=='PUT'){
		
			if($parametros[0]>0){
				$id = $parametros[0];

				$valida = call_user_func_array(array(new $classe, 'validaDado'), array($post));
				if(!$valida){
					$registro = call_user_func_array(array(new $classe, 'find'), $parametros);
					if(empty($registro)) { 
						$retorno['status'] = 'erro';
						$retorno['dados'] = "Registro $id do objeto $classe não localizado";	
					}else{
						$json = file_get_contents('php://input');
						$post = json_decode($json);
						
						$retorno = call_user_func_array(array(new $classe, 'update'), array($post,$id));
						
					}
				}else{
					$retorno = $valida;
				}
			}
		}elseif($tipo_requisicao=='DELETE'){
			
			if($parametros[0]>0){
				$id = $parametros[0];
				$registro = call_user_func_array(array(new $classe, 'find'), $parametros);
				if(empty($registro)) { 
					$retorno['status'] = 'erro';
					$retorno['dados'] = "Registro $id do objeto $classe não localizado";	
				}else{
					$retorno = call_user_func_array(array(new $classe, 'delete'), array($id));
					
				}
			}
		}

		return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
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