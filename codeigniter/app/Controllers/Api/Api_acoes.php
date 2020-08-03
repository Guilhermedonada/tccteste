<?php namespace App\Controllers\Api;

use App\Models\AcoesModel;
use App\Models\AgendaModel;
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
		date_default_timezone_set('America/Sao_Paulo');

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



	function TempoLeituras(){

		$agendaModel = new AgendaModel;
			
		$tempo = $agendaModel->orderBy('id desc')->limit(1)->find();

		return $this->respond($tempo, 200);

	}
	
	public function SalvarAgenda($tempo){

		date_default_timezone_set('America/Sao_Paulo');


		$agendaModel = new AgendaModel;
		

		$divisao = 86400 / $tempo; // 1 dia / 1 minuto


		$agendaModel->builder()->truncate();


		$data_inicio =  time();
		for($i = 0; $i < $divisao; $i++ ) {			


		
		

			$data = [
		    	'id_estacao' => 1,
		    	'data_criacao' =>  date('Y-m-d H:i:s'),
		    	'data_execucao' =>   date('Y-m-d H:i:s',   $data_inicio),
		    	'data_cancelamento' => NULL,
		    	'tempo_leitura' => $tempo
			];

			$agendaModel->builder()->insert($data);

			$data_inicio = $data_inicio + $tempo;	
			

			
			
			

		



			
			



			echo "<pre>";  print_r($data_inicio); echo "</pre>";

		}

		$mensagem = 'Enviada requisição';

		return $this->respond($mensagem, 200);
	}

	//executado pelo cron
	public function DisparadorEventos(){

		date_default_timezone_set('America/Sao_Paulo');

		$data_local = date('Y-m-d H:i:s');

		$agendaModel = new AgendaModel;
		$acoesModel = new AcoesModel;	

		// $where = "MONTH(".$data_local.") = MONTH(data_execucao) AND YEAR(".$data_local.") = YEAR(data_execucao) AND DAY(".$data_local.") = DAY(data_execucao) AND HOUR(".$data_local.") = HOUR(data_execucao) AND MINUTE(".$data_local.") = MINUTE(data_execucao)";

		$data = time();

		$p1 = $data - 60;
		$p2 = $data + 60;
		$data_anterior = date('Y-m-d H:i:s' , $p1);
		$data_proxima = date('Y-m-d H:i:s' , $p2);

		$agenda = $agendaModel->builder()->query('SELECT * FROM agenda WHERE data_execucao BETWEEN "'.$data_anterior.'"  AND "'.$data_proxima.'"   LIMIT 1')->getResult();

		//$agenda = $agendaModel->builder()->where('data_execucao = " '.date('Y-m-d H:i').'  "')->limit(1)->find();
		
	
		//$agenda =  $agendaModel->builder()->getLastQuery();
		// $agenda = $agendaModel->builder()->where('DATE(data_execucao) BETWEEN '.$data_local. ' 00:00:00 AND '.$data_local. ' 23:59:59 ')->limit(1)->find();

		// where('data_execucao = " '.date('Y-m-d H:i').'  "')

		print_r($agenda);

		if($agenda){

			$data = [
        		'medir' => 1
			];

  			$acoesModel->builder()->update(1, $data);
 
  			$mensagem = 'Enviada requisição';

			return $this->respond($mensagem, 200);
		}

	}


	//executado pelo cron
	public function CriaAgendaDiaria(){

		date_default_timezone_set('America/Sao_Paulo');

		$agendaModel = new AgendaModel;
			
		$tempo = $agendaModel->orderBy('id desc')->limit(1)->find();

		$data_inicio = time();

		$divisao = 86400 / $tempo; // 1 dia / 1 minuto


		$agendaModel->builder()->truncate();


		for($i = 0; $i < $divisao; $i++ ) {			


			$data = [
		    	'id_estacao' => 1,
		       	'data_criacao' =>  date('Y-m-d H:i:s'),
		    	'data_execucao' =>   date('Y-m-d H:i:s',   $data_inicio),
		    	'data_cancelamento' => NULL,
		    	'tempo_leitura' => $tempo
			];

			$agendaModel->builder()->insert($data);

			$data_inicio = $data_inicio + $tempo;

		}

	}



}