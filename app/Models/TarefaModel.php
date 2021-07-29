<?php

namespace App\Models;

use CodeIgniter\Model;

class TarefaModel extends Model
{
    protected $table = 'tarefas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = ['responsavel_id', 'categoria_id', 'titulo', 'descricao', 'data_finalizacao'];

    protected $useTimestamps = true;


    public function getTarefas($id = null){
        $this->select("{$this->table}.*, r.nome as responsavel, c.descricao as categoria");
        $this->join('responsaveis r', "r.id = {$this->table}.responsavel_id");
		$this->join('categorias c', "c.id = {$this->table}.categoria_id");

        if ($id){
            $this->where("{$this->table}.id = {$id}");
        }

        return $this;
    }
}