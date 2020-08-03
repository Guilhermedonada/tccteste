<?php namespace App\Models;
use CodeIgniter\Model;

class AgendaModel extends Model 
{
	protected $table = 'agenda';
    protected $primaryKey = 'id';   
    protected $useSoftDeletes = false;
    //protected $softDelete = false;
    protected $returnType = 'object';
	protected $allowedFields = ['id_usuario','data_criacao', 'data_execucao', 'data_cancelamento','tempo_leitura'];

}
