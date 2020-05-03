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


	public function On_Off()
	{
		$acoesModel = new AcoesModel;

		$data = [
        	'medir' => 1,
        	'data' => date('Y-m-d H:m:s')
		];

  		$acoesModel->builder()->update(2, $data);
 
  		$mensagem = 'Enviada requisição';

		return $this->respond($mensagem, 200);
	}
}