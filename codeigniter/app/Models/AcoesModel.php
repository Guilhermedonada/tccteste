<?php namespace App\Models;
use CodeIgniter\Model;

class AcoesModel extends Model 
{
	protected $table = 'acoes';
    protected $primaryKey = 'id';   
    protected $useSoftDeletes = false;
    //protected $softDelete = false;
    protected $returnType = 'object';
	protected $allowedFields = ['medir','canal', 'limite_inferior', 'limite_superior' ,'data'];

}
