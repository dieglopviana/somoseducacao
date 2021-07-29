<?php

namespace App\Controllers;

use App\Models\ResponsavelModel;
use App\Models\CategoriaModel;
use App\Models\TarefaModel;

class Tarefa extends BaseController
{
	public $responsaveis;
	public $categorias;
	public $tarefa;


	public function __construct()
	{
		$this->responsaveis = new ResponsavelModel();
		$this->categorias = new CategoriaModel();
		$this->tarefa = new TarefaModel();
	}
	
	
	public function index()
	{
		return view('tarefa/index', [
			'tarefas' => $this->tarefa->getTarefas()->paginate(5, 'tarefas'),
			'pager'   => $this->tarefa->pager,
		]);
	}


	public function detalhes($id){
		return view('tarefa/detalhes', [
			'tarefas' => $this->tarefa->getTarefas($id)->get()->getRowArray(),
		]);
	}


	public function form($id = ''){
		$responsaveis = $this->responsaveis->findAll();
		
		$categorias = $this->categorias->findAll();
		
		if ( ! empty($id)){
			$tarefa = $this->tarefa->find($id);
			
			return view('tarefa/form', [
				'tarefa' => $tarefa,
				'responsaveis' => $responsaveis,
				'categorias' => $categorias
			]);
		}
		
		return view('tarefa/form', [
			'responsaveis' => $responsaveis,
			'categorias' => $categorias
		]);
	}


	public function create(){
		if ($this->request->isAJAX()){
			$validation = \Config\Services::validation();
			$validation->setRuleGroup('tarefa');
			
			if ($validation->withRequest($this->request)->run()){
				$id = $this->request->getVar('id');
				
				$data = [
					'responsavel_id' => $this->request->getVar('responsavel_id'),
					'categoria_id' => $this->request->getVar('categoria_id'),
					'titulo' => $this->request->getVar('titulo'),
					'descricao' => $this->request->getVar('descricao'),
					'data_finalizacao' => $this->request->getVar('data_finalizacao'),
				];
				
				if (empty($id)){
					if ($this->tarefa->save($data)){
						return $this->response->setJSON(['status_error' => 0]);
					}
				} else {
					if ($this->tarefa->update($id, $data)){
						return $this->response->setJSON(['status_error' => 0]);
					}
				}
			} else {
				return $this->response->setJSON(['status_error' => 1, 'validator' => $validation->getErrors()]);
			}
		}
	}


	public function delete(){
		if ($this->request->isAJAX()){
			$id = $this->request->getVar('id');
			$tarefa = $this->tarefa->find($id);

			if ($tarefa){
				try {
					if ($this->tarefa->delete($tarefa['id'])){
						return $this->response->setJSON(['status_error' => 0]);
					}

					throw new Exception('Não foi possível excluir a categoria');
				} catch (\Exception $e) {
					return $this->response->setJSON(['status_error' => 1, 'error' => $e->getMessage()]);
				}
			}
			
			return $this->response->setJSON(['status_error' => 1, 'error' => 'Código de categoria inválido']);
		}
	}

}
