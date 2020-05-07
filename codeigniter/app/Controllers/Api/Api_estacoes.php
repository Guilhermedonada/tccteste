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

	public function Api_filtrar_temperatura($mes, $data_inicial, $data_final)
	{
		$estacoesModel = new EstacoesModel;

		$where = "data_upload BETWEEN '2020-".$mes. "-" .$data_inicial.  " 00:00:00' AND '2020-".$mes."-".$data_final. " 00:00:00'";

		$estacoes = $estacoesModel->where($where)->find();;

		
		return $this->respond($estacoes, 200);
	}
}