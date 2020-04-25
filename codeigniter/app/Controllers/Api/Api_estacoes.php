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
}