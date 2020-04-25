<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\LoginModel;

class Login extends Controller
{

	//public $session=null;
	public function __construct()
	{
		$this->session = \Config\Services::session();
	}

	public function autenticar()
	{
		$loginModel = new LoginModel;
		
		$email = $this->request->getVar('email');
		$senha = $this->request->getVar('senha');

		$data = [
        	'email' => $email,
        	'senha'    => $senha
		];

		$usuario = $loginModel->where($data)->find();

		if($usuario){
			$this->session->set('usuario',$usuario[0]);
		} else {
			die();
		}
		return view('estacoes_area');
	}

	public function deslogar()
	{
		$this->session->destroy();
		return redirect()->to(site_url('Home'));
	}



	public function login_area()
	{
		$this->session->destroy();
		return view('login');
	}


	//--------------------------------------------------------------------

}
