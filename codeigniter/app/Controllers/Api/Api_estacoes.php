<?php namespace App\Controllers\Api;

use App\Models\EstacoesModel;
use CodeIgniter\API\ResponseTrait;

class Api_estacoes extends \CodeIgniter\Controller
{
    use ResponseTrait;

	public function index()
	{
		$estacoesModel = new EstacoesModel;
		$estacoes = $estacoesModel->orderBy('data_upload desc')->findAll();

		return $this->respond($estacoes, 200);
	}

	public function ler_sensores($quantidade, $mes, $data_inicial, $data_final)
	{
		$estacoesModel = new EstacoesModel;

		//filtro
		if(($mes != '0') && ($data_inicial != '0') && ($data_final != '0')){
		
			$where = "data_upload BETWEEN '2020-".$mes. "-" .$data_inicial.  " 00:00:00' AND '2020-".$mes."-".$data_final. " 23:59:59'";

			$estacoes = $estacoesModel->where($where)->orderBy('data_upload desc')->find();

		} else {
			// print_r("entrou else");
			$estacoes = $estacoesModel->limit($quantidade)->orderBy('data_upload desc')->find();
		}
	

		return $this->respond($estacoes, 200);
	}

	public function ler_bateria()
	{
		$estacoesModel = new EstacoesModel;
		$estacoes = $estacoesModel->orderBy('data_upload desc')->limit(1)->find();
		return $this->respond($estacoes, 200);
	}

}