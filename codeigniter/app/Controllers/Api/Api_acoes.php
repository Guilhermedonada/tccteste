<?php namespace App\Controllers\Api;

use App\Models\AcoesModel;
use CodeIgniter\API\ResponseTrait;

class Api_acoes extends \CodeIgniter\Controller
{
    use ResponseTrait;

	public function index()
	{
		$acoesModel = new AcoesModel;

		$data = [
        	'medir' => 1,
        	'data' => date('Y-m-d H:m:s')
		];

  		$acoesModel->builder()->update(1, $data);
 
  		$mensagem = 'Enviada requisição';

		return $this->respond($mensagem, 200);
	}


	public function On_Off($estado)
	{
		$acoesModel = new AcoesModel;

		$data = [
        	'medir' => $estado,
    	  	'canal' => 0,
        	'limite_inferior' => 0,
        	'limite_superior' => 0,
        	'data' => date('Y-m-d H:m:s')
		];

  		$acoesModel->builder()->update(2, $data);
 
  		$mensagem = 'Enviada requisição';

		return $this->respond($mensagem, 200);
	}

	public function get_On_Off(){
		$acoesModel = new AcoesModel;
			
		$acoes_on_off = $acoesModel->where('id', 2)->find();

		return $this->respond($acoes_on_off, 200);
	}


	public function Limite($estado, $canal, $limite_inferior, $limite_superior)
	{

		//coloca 0 a esquerda para fechar 4 valores 
		$lim_inferior = str_pad($limite_inferior, 4, "0", STR_PAD_LEFT); 
		$lim_superior = str_pad($limite_superior, 4, "0", STR_PAD_LEFT); 

		$acoesModel = new AcoesModel;

		$data = [
        	'medir' => $estado,
        	'canal' => $canal,
        	'limite_inferior' => $lim_inferior,
        	'limite_superior' => $lim_superior,
        	'data' => date('Y-m-d H:m:s')
		];

  		$acoesModel->builder()->update(2, $data);
 
  		$mensagem = 'Enviada requisição';

		return $this->respond($mensagem, 200);
	}


	public function DeepSleep($estado)
	{
		$acoesModel = new AcoesModel;

		$data = [
        	'medir' => $estado,
        	'canal' => 0,
        	'limite_inferior' => 0,
        	'limite_superior' => 0,
        	'data' => date('Y-m-d H:m:s')
		];

  		$acoesModel->builder()->update(2, $data);
 
  		$mensagem = 'Enviada requisição';

		return $this->respond($mensagem, 200);
	}
}