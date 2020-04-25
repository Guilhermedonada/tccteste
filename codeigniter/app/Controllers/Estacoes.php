<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\EstacoesModel;

class Estacoes extends BaseController
{
	public function index()
	{
		return view('estacoes_area');
	}
}
