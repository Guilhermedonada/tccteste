<?php namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model 
{
	protected $table = 'usuarios';
    protected $primaryKey = 'id';   
    protected $useSoftDeletes = false;
    //protected $softDelete = false;
    protected $returnType = 'object';
	protected $allowedFields = ['email','senha'];


	public static function verifica_sessao($redirect=true){
		if(isset($_SESSION['usuario'])){
		//	print_r($_SESSION);
		//	die();
			return true;
		} else {
			if($redirect){
				return redirect()->to(site_url('Login/login_area'));
			}else{
				return false;
			}

			
		}
	}

}

