<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
	public $responsavel;


	public function __construct()
	{
		$this->categoria = new CategoriaModel();
	}
	
	
	public function index()
	{
		return view('categoria/index', [
			'categorias'   => $this->categoria->paginate(5, 'categorias'),
			'pager'        => $this->categoria->pager,
		]);
	}


	public function form($id = ''){
		if ( ! empty($id)){
			$categoria = $this->categoria->find($id);

			return view('categoria/form', ['categoria' => $categoria]);
		}
		
		return view('categoria/form');
	}


	public function create(){
		if ($this->request->isAJAX()){
			$validation = \Config\Services::validation();
			$validation->setRuleGroup('categoria');
			
			if ($validation->withRequest($this->request)->run()){
				$descricao = $this->request->getVar('descricao');
				$id        = $this->request->getVar('id');
				
				$data = ['descricao' => $descricao];

				if (empty($id)){
					if ($this->categoria->save($data)){
						return $this->response->setJSON(['status_error' => 0, $data]);
					}
				} else {
					if ($this->categoria->update($id, $data)){
						return $this->response->setJSON(['status_error' => 0, $data]);
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
			$categoria = $this->categoria->find($id);

			if ($categoria){
				try {
					if ($this->categoria->delete($categoria['id'])){
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
