<?php namespace App\Controllers\Api;

use App\Models\EstacoesModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;

class Api_estacoes extends \CodeIgniter\Controller
{
    use ResponseTrait;

	public function ler_sensores($busca)
    {

        $estacoesModel = new EstacoesModel;

        if($busca == 0){
            $estacoes = $estacoesModel->orderBy('id desc')->limit(1000)->find();
        } else {
        	$estacoes = $estacoesModel->orderBy('id desc')->limit(1)->find();
        }

		return $this->respond($estacoes, 200);
    }

	public function ler_bateria()
	{
		$estacoesModel = new EstacoesModel;
		$estacoes = $estacoesModel->orderBy('id desc')->limit(1)->find();
		return $this->respond($estacoes, 200);
	}

    public function filtrar_sensores()
    {   
    	$estacoesModel = new EstacoesModel;

        $data_inicial = $this->request->getVar('data_inicial');
        $data_final = $this->request->getVar('data_final');

        $datahora_inicial = date('Y-m-d H:i:s', strtotime($data_inicial));
        $datahora_final = date('Y-m-d H:i:s', strtotime($data_final));      

        $where = "data_upload BETWEEN '" .$datahora_inicial.  "' AND '".$datahora_final. "'";

        $estacoes = $estacoesModel->where($where)->orderBy('id desc')->findAll();

        return $this->respond($estacoes, 200);
    }

}