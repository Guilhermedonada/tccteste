<?php namespace App\Models;
use CodeIgniter\Model;

class EstacoesModel extends Model 
{
	protected $table = 'estacoes';
    protected $primaryKey = 'id';   
    protected $useSoftDeletes = false;
    //protected $softDelete = false;
    protected $returnType = 'object';
	//protected $allowedFields = ['email','senha'];

}

